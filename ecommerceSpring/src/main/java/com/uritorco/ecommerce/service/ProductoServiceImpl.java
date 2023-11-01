package com.uritorco.ecommerce.service;

import java.util.Optional;
import org.springframework.beans.factory.annotation.Autowired;
import com.uritorco.ecommerce.model.Producto;
import com.uritorco.ecommerce.repository.ProductoRepository;

public class ProductoServiceImpl implements ProductoService {

    @Autowired
    private ProductoRepository productoRepository;

    @Override
    public void delete(Integer id) {
       productoRepository.deleteById(id);
    }

    @Override
    public Optional<Producto> get(Integer id) {
     
        return productoRepository.findById(id);
    }

    @Override
    public Producto save(Producto producto) {

        return productoRepository.save(producto);
    }

    @Override
    public void update(Producto producto) {
        productoRepository.save(producto);
    }
}
