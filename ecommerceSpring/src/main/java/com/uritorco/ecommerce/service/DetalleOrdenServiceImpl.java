package com.uritorco.ecommerce.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.uritorco.ecommerce.model.DetalleOrden;
import com.uritorco.ecommerce.repository.IDetalleOrdenRepository;

@Service
public class DetalleOrdenServiceImpl implements IDetalleOrdenService {


    @Autowired
    private IDetalleOrdenRepository detalleOrdenRepository;

    @Override
    public DetalleOrden save(DetalleOrden detalleOrden) {
        return detalleOrdenRepository.save(detalleOrden);
    }
    
}
