package birt.daw.apirest.repositorio;

import org.springframework.data.jpa.repository.JpaRepository;
import birt.daw.apirest.entity.Login;

public interface LoginRepositorio extends JpaRepository<Login, Integer> {
    boolean existsByUsername(String username);
}
