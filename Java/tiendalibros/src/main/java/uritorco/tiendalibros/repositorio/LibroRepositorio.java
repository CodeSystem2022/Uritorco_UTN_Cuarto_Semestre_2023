package uritorco.tiendalibros.repositorio;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import uritorco.tiendalibros.modelo.Libro;

@Repository
public interface LibroRepositorio extends JpaRepository<Libro, Integer> {

}
