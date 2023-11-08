package com.uritorco.ecommerce.service;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.uritorco.ecommerce.model.Orden;
import com.uritorco.ecommerce.model.Usuario;
import com.uritorco.ecommerce.repository.IOrdenRepository;

@Service
public class OrdenServiceImpl implements IOrdenService {

    @Autowired
    private IOrdenRepository ordenRepository;

    @Override
    public Orden save(Orden orden) {

        return ordenRepository.save(orden);
    }

    @Override
    public List<Orden> findAll() {
      
        return ordenRepository.findAll();
    }

    public String generarNumeroOrden() {

        int numero = 0;
        String numeroConcat = "";

        List<Orden> ordenes = findAll();
        List<Integer> numeros = new ArrayList<Integer>();

        ordenes.stream().forEach(o -> numeros.add(Integer.parseInt(o.getNumero())));

        if (ordenes.isEmpty()) {
            numero = 1;
        } else {
            numero = numeros.stream().max(Integer::compare).get();
            numero++;
        }

        //Para el número de pedido. >v
        //TODO: Buscar una forma más fácil
        if (numero < 10) {
            numeroConcat = "000000000" + String.valueOf(numero);
        } else if (numero < 100) {
            numeroConcat = "00000000" + String.valueOf(numero);
        } else if (numero < 1000) {
            numeroConcat = "0000000" + String.valueOf(numero);
        }  else if (numero < 10000) {
            numeroConcat = "000000" + String.valueOf(numero);
        }

        return numeroConcat;
    }

    @Override
    public List<Orden> findByUsuario(Usuario usuario) {
        return ordenRepository.findByUsuario(usuario);
    }

    @Override
    public Optional<Orden> findById(Integer id) {
        return ordenRepository.findById(id);
    }   
}
