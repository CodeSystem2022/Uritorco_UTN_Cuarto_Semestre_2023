package com.uritorco.ecommerce.controller;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;

import com.uritorco.ecommerce.model.DetalleOrden;
import com.uritorco.ecommerce.model.Orden;
import com.uritorco.ecommerce.model.Producto;
import com.uritorco.ecommerce.service.ProductoService;

@Controller
@RequestMapping("/")
public class HomeController {

    List<DetalleOrden> detalles = new ArrayList<DetalleOrden>(); //Lista de detalles para pasar del carrito al checkout
    Orden orden = new Orden(); //Datos del pedido

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

    @PostMapping("/cart")
    public String addCart(@RequestParam Integer id, @RequestParam Integer cantidad, Model model) {

        DetalleOrden detalleOrden = new DetalleOrden();
        Producto producto = new Producto();
        double sumaTotal = 0;
        
        Optional<Producto> optionalProducto = productoService.get(id);
        producto = optionalProducto.get();
        
        detalleOrden.setCantidad(cantidad);
        detalleOrden.setPrecio(producto.getPrecio());
        detalleOrden.setNombre(producto.getNombre());
        detalleOrden.setTotal(producto.getPrecio()*cantidad);
        detalleOrden.setProducto(producto);

        detalles.add(detalleOrden); //esto añade cada producto a la lista del carrito

        sumaTotal = detalles.stream().mapToDouble(dt -> dt.getTotal()).sum();
        orden.setTotal(sumaTotal);

        model.addAttribute("cart", detalles);
        model.addAttribute("orden", orden);



        return "usuario/carrito";
    }


}
