package com.uritorco.ecommerce.controller;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;

import com.uritorco.ecommerce.model.Orden;
import com.uritorco.ecommerce.model.Usuario;
import com.uritorco.ecommerce.service.IOrdenService;
import com.uritorco.ecommerce.service.IUsuarioService;

import jakarta.servlet.http.HttpSession;

@Controller
@RequestMapping("/usuario")
public class UsuarioController {
    
    @Autowired
    private IUsuarioService usuarioService;

    @Autowired
    private IOrdenService ordenService;

    @GetMapping("/registro")
    public String create() {
        
        return "usuario/registro";
    }

    @PostMapping("/save")
    public String save(Usuario usuario) {
        
        usuario.setTipo("USER");
        usuarioService.save(usuario);
        
        return "redirect:/";
    }

    @GetMapping("/login")
    public String login() {
        
        return "usuario/login";
    }

    @PostMapping("/acceder")
    public String acceder(Usuario usuario, HttpSession httpSession) {

        Optional<Usuario> user = usuarioService.findByEmail(usuario.getEmail());

        if (user.isPresent()) {
            httpSession.setAttribute("idusuario", user.get().getId());
            if (user.get().getTipo().equals("ADMIN")) {
                return "redirect:/administrador";
            } else {
                return "redirect:/"; //else redundante...
            }
        } else {
            System.err.println("Usuario no existe");
        }

        return "redirect:/";
    }

    @GetMapping("/compras")
    public String obtenerCompras(HttpSession httpSession, Model model) {

        model.addAttribute("sesion", httpSession.getAttribute("idusuario"));
        Usuario usuario = usuarioService.findById(Integer.parseInt(httpSession.getAttribute("idusuario").toString())).get();
        List<Orden> ordenes = ordenService.findByUsuario(usuario);
        model.addAttribute("ordenes", ordenes);

        return "usuario/compras";
    }

    @GetMapping("/detalle/{id}")
    public String detalleCompra(@PathVariable Integer id, HttpSession httpSession, Model model) {

        Optional<Orden> orden = ordenService.findById(id);

        model.addAttribute("detalles", orden.get().getDetalle());
        model.addAttribute("sesion", httpSession.getAttribute("idusuario"));

        return "usuario/detallecompra";
    }

    @GetMapping("/cerrar")
    public String cerrarSesion(HttpSession httpSession){

        httpSession.removeAttribute("idusuario");
        

        return "redirect:/";
    }

}
