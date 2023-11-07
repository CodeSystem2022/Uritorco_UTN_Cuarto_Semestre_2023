package com.uritorco.ecommerce.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.uritorco.ecommerce.model.DetalleOrden;

@Repository
public interface IDetalleOrdenRepository extends JpaRepository<DetalleOrden, Integer> {
    
}
