package birt.daw.apirest.excepciones;

import java.util.List;
import org.springframework.dao.DataIntegrityViolationException;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import birt.daw.apirest.dto.ApiResponse;
import org.springframework.web.bind.MethodArgumentNotValidException;

@RestControllerAdvice
public class LoginExceptionHandler {

	// Con esta excepción controlo cuando no encuentra datos en la BBD
	@ExceptionHandler(RuntimeException.class)
	public ResponseEntity<ApiResponse> handleRuntimeException(RuntimeException ex) {
		ApiResponse response = new ApiResponse("error", HttpStatus.NOT_FOUND.value(), "⚠️ No se encontraron datos",
				List.of());
		return new ResponseEntity<>(response, HttpStatus.NOT_FOUND);
	}

	// Con esta excepción controlo si ya existe un login con el mismo nombre al
	// intentar crear
	@ExceptionHandler(IllegalArgumentException.class)
	public ResponseEntity<ApiResponse> handleIllegalArgument(IllegalArgumentException ex) {
		ApiResponse response = new ApiResponse("error", HttpStatus.BAD_REQUEST.value(),
				"⚠️ Ya existe un login con ese nombre.", List.of());
		return new ResponseEntity<>(response, HttpStatus.BAD_REQUEST);
	}

	@ExceptionHandler(DataIntegrityViolationException.class)
	public ResponseEntity<ApiResponse> handleDataIntegrityViolation(DataIntegrityViolationException ex) {
		ApiResponse response = new ApiResponse("error", HttpStatus.BAD_REQUEST.value(),
				"⚠️ Ya existe un login con ese nombre.", List.of());
		return new ResponseEntity<>(response, HttpStatus.BAD_REQUEST);
	}

	@ExceptionHandler(Exception.class)
	public ResponseEntity<ApiResponse> handleGenericException(Exception ex) {
		ex.printStackTrace(); // solo para depuración
		ApiResponse response = new ApiResponse("error", 500, "❌ Error inesperado en el servidor.",
				List.of(ex.getMessage()));
		return new ResponseEntity<>(response, HttpStatus.INTERNAL_SERVER_ERROR);
	}

	@ExceptionHandler(MethodArgumentNotValidException.class)
	public ResponseEntity<ApiResponse> handleValidationErrors(MethodArgumentNotValidException ex) {
		String errorMsg = ex.getBindingResult().getFieldErrors().stream()
				.map(fieldError -> fieldError.getDefaultMessage()).findFirst().orElse("Datos inválidos");
		ApiResponse response = new ApiResponse("error", 400, "⚠️ " + errorMsg, List.of());
		return new ResponseEntity<>(response, HttpStatus.BAD_REQUEST);
	}

}
