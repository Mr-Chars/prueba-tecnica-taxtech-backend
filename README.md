# Aplicación desafio tax technologi

El presente proyecto despliega un api crud de clientes según las información y alcance solicitado,

## Tecnologías utilizadas

* PHP - Slim 3 framework
* Base de Datos: MySql 8
* Paradigma POO y funcional

## Como desplegar

Es necesario contar con un servidor que corra php ya sea apache, nginx, etc

### ENDPOINTS

HTTP Method | URL | Auth | Descripción
--- | --- | --- | ---
GET | `/listclients` | No | Devuelve una lista de todos los clientes.
POST | `/createclient` | No | Recibe nombre, apellido, edad, fecha de nacimiento y DNI.
PUT | `/updateclient/{dni}` | No | Actualiza los datos de un cliente basándose en el DNI.
DELETE | `/deleteclient/{dni}` | No | Elimina un cliente basándose en su DNI (Eliminación lógica).