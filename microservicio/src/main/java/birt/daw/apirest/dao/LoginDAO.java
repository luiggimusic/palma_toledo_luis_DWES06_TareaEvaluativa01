package birt.daw.apirest.dao;

import java.util.List;

import birt.daw.apirest.entity.Login;

public interface LoginDAO {
	public List<Login> findAll();
	
	public Login findById(int id);
	
	public Login save(Login login);
	
	public Login deleteById(int id);

}
