- Secuence inputs : Basados en un día de la semnaa, del mes, o en función del inicio de la secuencia.

- Contactos (Datos básicos, nombre, apellidos, perfil LI, Ubicación, sector)
- Estados del contacto (No contactado / No interesado / Interesado / En conversación / Ganado / No cualifica)
- Secuencias (Nombre, descripción, relación secuencia prospecto (fecha inclusión secuencia))
- Puntos de contacto de secuencia (orden, mensaje, tiempo en que debe ocurrir (opciones para un día de la semana / mes, o dinámicamente en función del inicio de la secuencia), objetivo).
- Recordatorios (en el dashboard, básicamente, de auquellas interacciones previstas según la secuencia...) Si no se han marcado como hechas, quedan pendientes para el día siguiente ¿Los gestiono con notificaciones? No lo sé bien aún.

Relaciones:
    Prospecto - Secuencia (Muchos a muchos)
    Puntos de secuencia - Prospectos (Muchos a muchos) (Controlados por la secuencia)
    Secuencia - Puntos de secuencia (Uno a muchos)
    Prospecto - Interacciones (Uno a muchos)

    Prospecto - Localización (Uno a uno)
    Prospecto - Sector (Uno a uno)
    Propsecto - Estado (Uno a uno)

TODO

- [X] Crear modelos
- [X] Crear las tablas pivote
- [X] Seeders
- [X] CRUD con Livewire
    - [X] Estados del prospecto
    - [X] Prospectos
    - [X] Secuencias
    - [X] Puntos de secuencia
        - [X] Crear
        - [X] Editar
        - [X] Eliminar
        - [X] Ver
    - [X] Interacciones
- [X] Campos dinámicos en los puntos de las secuencias
- [X] Localización de los prospectos
    - [X] CRUD
- [ ] Notificaciones automáticas en el desk

## Ideas para implementar si es posible
Marcar puntos de secuencia directamente como realizados.

De esta forma, en la vista de show que hemos trabajado, en la parte de secuencias, debería poder ver directamente cuándo es el siguiente mensaje y de cuál se trata, por ejemplo, así tengo un gran control.

Luego en el dashboard se muestra todo lo que hay que hacer hoy o se debería haber hecho en días pasados pero no está marcado como hecho

Debe existir la posibilidad de pausar o eliminar una secuencia para un prospecto.

- [ ] Revisar modelo y relaciones sequence points
- [ ] Asignar a los prospectos las secuencias correspondientes
- [ ] Eliminar logs

## Difusión

A los canales de The KLUB y publicación en LI y a los canales de la comunidad de Sales Hackers.


