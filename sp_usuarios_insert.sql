DELIMITER //
CREATE PROCEDURE sp_usuarios_insert (
	plogin VARCHAR(20),
	psenha VARCHAR(20)
)
BEGIN
	INSERT INTO usuarios(login, senha) VALUES(plogin, psenha);
	
	SELECT * FROM usuarios WHERE id = LAST_INSERT_ID();
END //

DELIMITER ;