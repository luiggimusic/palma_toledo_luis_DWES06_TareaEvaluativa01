package birt.daw.apirest.servicio;

import java.util.List;

import birt.daw.apirest.entity.Login;

public interface ServicioLogin {
	public List<Login> findAll();
	
	public Login findById(int id);
	
	public Login save(Login login);
	
	public Login update(Login login);
	
	public Login deleteById(int id);
	
	boolean existsByUsername(String username);
}
