package birt.daw.apirest.dao;

import java.util.List;

import org.hibernate.Session;
import org.hibernate.query.Query;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import birt.daw.apirest.entity.Login;
import jakarta.persistence.EntityManager;
import jakarta.transaction.Transactional;

@Repository
public class LoginDAOImpl implements LoginDAO {
	@Autowired
	private EntityManager entityManager;

	@Override
	@Transactional
	public List<Login> findAll() {
		Session currentSession=entityManager.unwrap(Session.class);
		Query<Login> theQuery= currentSession.createQuery("from Login",Login.class);
		List<Login> usersLogin = theQuery.getResultList();
		return usersLogin;
	}
 
	@Override
	@Transactional
	public Login findById(int id) {
		Session currentSession = entityManager.unwrap(Session.class);
		Login userLogin = currentSession.get(Login.class, id);
		return userLogin;
	}

	@Override
	@Transactional
	public Login save(Login userLogin) {
	    Session currentSession = entityManager.unwrap(Session.class);
	    return (Login) currentSession.merge(userLogin);
	}

	@Override
	@Transactional
	public Login deleteById(int id) {
	    Login existente = entityManager.find(Login.class, id);

	    if (existente != null) {
	        entityManager.remove(existente);
	    }

	    return existente;
	}
}
