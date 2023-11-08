package com.uritorco.ecommerce.service;

import java.util.Optional;

import org.springframework.stereotype.Service;

import com.uritorco.ecommerce.model.Usuario;

@Service
public interface IUsuarioService {
    
    Optional<Usuario> findById(Integer id);
    Usuario save(Usuario usuario);
    Optional<Usuario> findByEmail(String email);
    
}
