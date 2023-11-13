package com.uritorco.ecommerce.controller;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RestController;

import com.mercadopago.MercadoPagoConfig;
import com.mercadopago.client.preference.PreferenceClient;
import com.mercadopago.client.preference.PreferenceItemRequest;
import com.mercadopago.client.preference.PreferenceRequest;
import com.mercadopago.resources.preference.Preference;

import jakarta.servlet.http.HttpSession;

@RestController
public class MPagoController {

    @PostMapping("/create-mercadopago-preference")
    public ResponseEntity<String> createMercadoPagoPreference(HttpSession httpSession) {
        
        try {
            // Set your Mercado Pago access token
            MercadoPagoConfig.setAccessToken("PROD_ACCESS_TOKEN");

            // Create a PreferenceItemRequest
            PreferenceItemRequest itemRequest = PreferenceItemRequest.builder()
                .id("1234")
                .title("Games")
                .description("PS5")
                .pictureUrl("http://picture.com/PS5")
                .categoryId("games")
                .quantity(2)
                .currencyId("BRL")
                .unitPrice(new BigDecimal("4000"))
                .build();

            // Create a list of items
            List<PreferenceItemRequest> items = new ArrayList<>();
            items.add(itemRequest);
            // Create a PreferenceRequest with the list of items
            PreferenceRequest preferenceRequest = PreferenceRequest.builder()
                .items(items)
                .build();
            // Use the Mercado Pago SDK to create the preference
            PreferenceClient client = new PreferenceClient();
            PreferenceRequest request =
            PreferenceRequest.builder().items(items).purpose("wallet_purchase").build();
            Preference preference = client.create(request);

            return new ResponseEntity<>("Preference created with ID: " + preference.getId(), HttpStatus.OK);
        } catch (Exception e) {
            e.printStackTrace();
            return new ResponseEntity<>("Failed to create Mercado Pago preference: " + e.getMessage(), HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
}