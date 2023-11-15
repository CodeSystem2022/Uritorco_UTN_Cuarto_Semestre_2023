package uritorco.tiendalibros;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.WebApplicationType;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.builder.SpringApplicationBuilder;
import org.springframework.context.ConfigurableApplicationContext;
import org.springframework.context.annotation.ComponentScan;
import uritorco.tiendalibros.vista.LibroForm;

import java.awt.*;

@SpringBootApplication
public class TiendalibrosApplication {

	public static void main(String[] args) {
		SpringApplication.run(TiendalibrosApplication.class, args);

		ConfigurableApplicationContext contextoSpring = new SpringApplicationBuilder(TiendalibrosApplication.class)
				.headless(false)
				.web(WebApplicationType.NONE)
				.run(args);

		EventQueue.invokeLater(() -> {
			LibroForm libroFrom = contextoSpring.getBean(LibroForm.class);
			libroFrom.setVisible(true);
		});
	}
}

