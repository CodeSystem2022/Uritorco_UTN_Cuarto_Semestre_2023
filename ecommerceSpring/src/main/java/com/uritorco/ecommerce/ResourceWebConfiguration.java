package com.uritorco.ecommerce;

import org.springframework.context.annotation.Configuration;
import org.springframework.web.servlet.config.annotation.ResourceHandlerRegistry;
import org.springframework.web.servlet.config.annotation.WebMvcConfigurer;
import com.mercadopago.MercadoPagoConfig;

@Configuration
public class ResourceWebConfiguration implements WebMvcConfigurer {
    
    @Override
    public void addResourceHandlers(ResourceHandlerRegistry registry) {
       
        registry.addResourceHandler("/images/**").addResourceLocations("file:images/");
        MercadoPagoConfig.setAccessToken("TEST-8256649318085417-110911-cfd7fd0836f69334724e9db8632342ef-125114950");

        
        
    }

    

}
