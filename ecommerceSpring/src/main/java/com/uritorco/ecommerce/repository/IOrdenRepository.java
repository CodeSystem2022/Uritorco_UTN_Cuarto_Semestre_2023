package com.uritorco.ecommerce.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.uritorco.ecommerce.model.Orden;
import com.uritorco.ecommerce.model.Usuario;

import java.util.List;


@Repository
public interface IOrdenRepository extends JpaRepository<Orden, Integer> {
    List<Orden> findByUsuario(Usuario usuario);
}