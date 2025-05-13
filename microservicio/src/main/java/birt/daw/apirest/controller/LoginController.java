package birt.daw.apirest.controller;

import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import birt.daw.apirest.dto.ApiResponse;
import birt.daw.apirest.entity.Login;
import birt.daw.apirest.servicio.ServicioLogin;
import jakarta.validation.Valid;

@RestController
@RequestMapping("/api") // Raiz de la url: http://localhost:8080/api
public class LoginController {

	@Autowired
	private ServicioLogin loginServicio;

	@GetMapping("/login/get")
	public ResponseEntity<ApiResponse> findAll() {
		List<Login> usersLogin = loginServicio.findAll();

		if (usersLogin.isEmpty()) {
			ApiResponse response = new ApiResponse("error", 404, "⚠️ No se encontraron datos", usersLogin);
			return new ResponseEntity<>(response, HttpStatus.NOT_FOUND);
		}

		ApiResponse response = new ApiResponse("success", 200, "✅ Datos cargados correctamente", usersLogin);
		return ResponseEntity.ok(response);
	}

	@GetMapping("/login/get/{id}")
	public ResponseEntity<ApiResponse> findById(@PathVariable int id) {
		Login userLogin = loginServicio.findById(id);
		ApiResponse response = new ApiResponse("success", 200, "✅ Datos cargados correctamente", List.of(userLogin));
		return new ResponseEntity<>(response, HttpStatus.OK);
	}

	@PostMapping("/login/create")
	public ResponseEntity<ApiResponse> addLogin(@Valid @RequestBody Login userLogin) {
		userLogin.setId(0);
		Login savedLogin = loginServicio.save(userLogin);
		ApiResponse response = new ApiResponse("success", HttpStatus.OK.value(), "✅ Datos cargados correctamente",
				List.of(savedLogin));
		return new ResponseEntity<>(response, HttpStatus.OK);
	}

	@PutMapping("/login/updateUsername")
	public ResponseEntity<ApiResponse> updateLogin(@Valid @RequestBody Login userLogin) {
		Login updatedLogin = loginServicio.save(userLogin);
		ApiResponse response = new ApiResponse("success", HttpStatus.OK.value(), "✅ Datos cargados correctamente",
				List.of(updatedLogin));
		return new ResponseEntity<>(response, HttpStatus.OK);
	}

	@PutMapping("/login/updatePassword")
	public ResponseEntity<ApiResponse> updatePassword(@Valid @RequestBody Login userLogin) {
		Login updatedPassword = loginServicio.updatePassword(userLogin);
		ApiResponse response = new ApiResponse("success", HttpStatus.OK.value(), "✅ Datos cargados correctamente",
				List.of(updatedPassword));
		return new ResponseEntity<>(response, HttpStatus.OK);
	}

	@DeleteMapping("/login/delete/{id}")
	public ResponseEntity<ApiResponse> deleteLogin(@PathVariable int id) {
		
		Login loginDelete = loginServicio.deleteById(id);
		
		if (loginDelete == null) {
			ApiResponse response = new ApiResponse("error", HttpStatus.NOT_FOUND.value(), "⚠️ No se ha encontrado login con id: " + id, loginDelete);
			return new ResponseEntity<>(response, HttpStatus.NOT_FOUND);
		}
		
		ApiResponse response = new ApiResponse("success", HttpStatus.OK.value(), "✅ Login eliminado correctamente",
				loginDelete);
		return new ResponseEntity<ApiResponse>(response, HttpStatus.OK);

	}
}
