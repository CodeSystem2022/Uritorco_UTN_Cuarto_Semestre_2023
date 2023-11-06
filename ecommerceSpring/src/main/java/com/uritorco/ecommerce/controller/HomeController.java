package com.uritorco.ecommerce.controller;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;

import com.uritorco.ecommerce.model.Producto;
import com.uritorco.ecommerce.service.ProductoService;

@Controller
@RequestMapping("/")
public class HomeController {
    
    @Autowired //autowired inyecta una instancia de la clase
    private ProductoService productoService;

    @GetMapping("")
    public String home(Model model) {
        
        model.addAttribute("productos", productoService.findAll());

        return "usuario/home";
    }

    @GetMapping("productohome/{id}")
    public String productoHome(@PathVariable Integer id, Model model) { //model nos deja llevar info a la vista
        
        Producto producto = new Producto();
        Optional<Producto> productOptional = productoService.get(id);
        producto = productOptional.get();
        model.addAttribute("producto", producto);

        return "usuario/productohome";
    }

}
