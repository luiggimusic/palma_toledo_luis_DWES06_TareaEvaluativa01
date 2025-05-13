package birt.daw.apirest.servicio;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import birt.daw.apirest.entity.Login;
import birt.daw.apirest.repositorio.LoginRepositorio;
import birt.daw.apirest.dao.LoginDAO;

@Service
public class ServicioLoginImpl implements ServicioLogin {
	@Autowired
	private LoginDAO loginDAO;
	
	@Autowired
	private LoginRepositorio loginRepositorio;


	@Override
	public List<Login> findAll() {
		List<Login> listLogin = loginDAO.findAll();
		return listLogin;
	}

	@Override
	public Login findById(int id) {
		Login login = loginDAO.findById(id);
		return login;
	}

	@Override
	public Login save(Login login) {
		if (loginRepositorio.existsByUsername(login.getUsername())) {
		    throw new IllegalArgumentException("El nombre de usuario ya está en uso.");
		}
		return loginDAO.save(login);
	}
	
	@Override
	public Login updatePassword(Login login) {
		return loginDAO.save(login);
	}	
	
	@Override
	public Login deleteById(int id) {
		return loginDAO.deleteById(id);
	}
	
	@Override
	public boolean existsByUsername(String username) {
	    return loginRepositorio.existsByUsername(username);
	}
}
