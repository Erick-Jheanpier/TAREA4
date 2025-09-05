# 📚 Sistema de Biblioteca - CodeIgniter 4

Este proyecto es un **CRUD completo** para la gestión de una biblioteca.  
Permite administrar:

- **Recursos** (libros físicos y digitales)


⚠️ **Nota importante:**  
Recuerda configurar la conexión a tu base de datos en el archivo:

app/Config/Database.php



---

En mi laptop uso la contraseña `Erick2000`, pero tú debes reemplazarla por la contraseña que uses en tu propio servidor MySQL/MariaDB.

---

## 🚀 Tecnologías usadas

- [CodeIgniter 4](https://codeigniter.com/) (framework PHP MVC)
- [Bootstrap 5](https://getbootstrap.com/) (diseño responsivo)
- [SweetAlert2](https://sweetalert2.github.io/) (alertas amigables)
- **MySQL/MariaDB** como base de datos

---

## 📂 Estructura de la Base de Datos

```sql
CREATE DATABASE biblioteca;
USE biblioteca;

-- Tabla de Editoriales
CREATE TABLE editoriales (
    id_editorial INT AUTO_INCREMENT PRIMARY KEY,
    editorial VARCHAR(100) NOT NULL,
    nacionalidad VARCHAR(100) NOT NULL
);

-- Tabla de Categorías
CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(100) NOT NULL
);

-- Tabla de Subcategorías
CREATE TABLE subcategorias (
    id_subcategoria INT AUTO_INCREMENT PRIMARY KEY,
    subcategoria VARCHAR(100) NOT NULL,
    id_categoria INT NOT NULL,
    CONSTRAINT fk_categoria FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

-- Tabla de Recursos
CREATE TABLE recursos (
    id_recurso INT AUTO_INCREMENT PRIMARY KEY,
    id_subcategoria INT NOT NULL,
    id_editorial INT NOT NULL,
    tipo ENUM('Físico','Digital') NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    apublicacion YEAR NOT NULL,
    isbn VARCHAR(20) UNIQUE,
    numpaginas INT NOT NULL,
    rutaportada VARCHAR(255),
    rutarecurso VARCHAR(255),
    estado ENUM('Bueno','Regular','Malo') DEFAULT 'Bueno',
    creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_subcategoria FOREIGN KEY (id_subcategoria) REFERENCES subcategorias(id_subcategoria),
    CONSTRAINT fk_editorial FOREIGN KEY (id_editorial) REFERENCES editoriales(id_editorial)
);

-- Datos iniciales
INSERT INTO categorias (categoria) VALUES
('Matemáticas'),
('Comunicación'),
('Computación');

INSERT INTO subcategorias (subcategoria, id_categoria) VALUES
('Razonamiento Lógico Matemático', 1),
('Álgebra', 1),
('Trigonometría', 1),
('Razonamiento Verbal', 2),
('Composición', 2),
('Redacción', 2),
('Base de Datos', 3),
('Sistemas Operativos', 3),
('Lenguajes de Programación', 3);

INSERT INTO editoriales (editorial, nacionalidad) VALUES
('Santillana', 'España'),
('Pearson', 'Reino Unido'),
('McGraw-Hill', 'EEUU');

INSERT INTO recursos (id_subcategoria, id_editorial, tipo, titulo, apublicacion, isbn, numpaginas, rutaportada, rutarecurso, estado)
VALUES
(1, 1, 'Físico', 'Razonamiento Lógico Matemático - Nivel Básico', 2005, '978-84-111111-1-1', 250, 'portadas/razonamiento_logico.jpg', NULL, 'Bueno'),
(2, 1, 'Físico', 'Álgebra de Baldor', 2007, '978-84-111111-1-2', 560, 'portadas/algebra_baldor.jpg', NULL, 'Regular'),
(3, 3, 'Digital', 'Trigonometría Moderna', 2012, '978-84-111111-1-3', 430, 'portadas/trigonometria.jpg', 'recursos/trigonometria.pdf', 'Bueno'),
(4, 2, 'Digital', 'Razonamiento Verbal Avanzado', 2010, '978-84-222222-2-1', 300, 'portadas/razonamiento_verbal.jpg', 'recursos/razonamiento_verbal.pdf', 'Bueno'),
(5, 3, 'Físico', 'Composición y Estilo', 2014, '978-84-222222-2-2', 280, 'portadas/composicion.jpg', NULL, 'Regular'),
(6, 1, 'Físico', 'Manual de Redacción', 2008, '978-84-222222-2-3', 200, 'portadas/redaccion.jpg', NULL, 'Malo'),
(7, 2, 'Digital', 'Introducción a Bases de Datos', 2015, '978-84-333333-3-1', 550, 'portadas/base_datos.jpg', 'recursos/base_datos.pdf', 'Bueno'),
(8, 3, 'Físico', 'Fundamentos de Sistemas Operativos', 2009, '978-84-333333-3-2', 480, 'portadas/sistemas_operativos.jpg', NULL, 'Bueno'),
(9, 1, 'Digital', 'Lenguajes de Programación en la Actualidad', 2020, '978-84-333333-3-3', 620, 'portadas/lenguajes_programacion.jpg', 'recursos/lenguajes_programacion.pdf', 'Regular');

-- Vista con información completa
CREATE VIEW vw_recursos AS
SELECT 
    r.id_recurso,
    r.titulo,
    r.tipo,
    r.apublicacion,
    r.isbn,
    r.numpaginas,
    r.estado,
    r.creado,
    r.modificado,
    e.editorial,
    e.nacionalidad,
    c.categoria,
    s.subcategoria
FROM recursos r
INNER JOIN editoriales e ON r.id_editorial = e.id_editorial
INNER JOIN subcategorias s ON r.id_subcategoria = s.id_subcategoria
INNER JOIN categorias c ON s.id_categoria = c.id_categoria;

-- Consulta de prueba
SELECT * FROM vw_recursos;

