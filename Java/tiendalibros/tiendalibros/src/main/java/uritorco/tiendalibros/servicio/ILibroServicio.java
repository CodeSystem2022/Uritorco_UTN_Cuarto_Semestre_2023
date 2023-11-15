package uritorco.tiendalibros.servicio;

import uritorco.tiendalibros.modelo.Libro;

import java.util.List;

public interface ILibroServicio {

    public List<Libro> enlistarLibros();

    public Libro buscarLibroPorId(Integer idLibro);

    public void guardarLibro(Libro libro);

    public void eliminarLibro(Libro libro);
}
