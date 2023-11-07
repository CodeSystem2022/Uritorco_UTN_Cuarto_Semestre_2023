package com.uritorco.ecommerce.service;

import java.util.List;

import com.uritorco.ecommerce.model.Orden;

public interface IOrdenService {

    List<Orden> findAll();

    Orden save(Orden orden);
    
    String generarNumeroOrden();
}
