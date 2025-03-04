<style>
    /* Estilos para el formulario */
form {
    width: 100%;
    padding: 1.5rem;
    background-color: rgba(255, 255, 255, 0.05);
    border-radius: 0.8rem;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 1.5rem;
    gap: 0.5rem;
}

.form-group label {
    font-size: 1rem;
    font-weight: 500;
    color: #f0f0f0;
    margin-bottom: 0.5rem;
}

.form-group input {
    padding: 1rem;
    background-color: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 0.5rem;
    color: white;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-group input:focus {
    outline: none;
    border-color: #6c63ff;
    background-color: rgba(255, 255, 255, 0.12);
    box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.25);
}

.form-group button[type="submit"] {
    padding: 1rem 2rem;
    background-color: #6c63ff;
    color: white;
    border: none;
    border-radius: 0.5rem;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    align-self: flex-start;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.form-group button[type="submit"]:hover {
    background-color: #8a82ff;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* Efecto de enfoque para accesibilidad */
.form-group button[type="submit"]:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.5);
}

/* Título del formulario si quieres agregarlo */
.form-title {
    font-size: 1.5rem;
    color: #f0f0f0;
    margin-bottom: 1.5rem;
    text-align: center;
    font-weight: 600;
}

/* Animación en el input */
@keyframes focusGlow {
    0% { box-shadow: 0 0 0 0 rgba(108, 99, 255, 0.4); }
    70% { box-shadow: 0 0 0 5px rgba(108, 99, 255, 0); }
    100% { box-shadow: 0 0 0 0 rgba(108, 99, 255, 0); }
}

.form-group input:focus {
    animation: focusGlow 1.5s infinite;
}
</style>

<div class="view">
    <a href='/rol/index'><i class="fas fa-user-tag"></i> Roles</a>
    <a href='/actividad/index'><i class="fas fa-tasks"></i> Actividades</a>
    <a href='/centro/index'><i class="fas fa-building"></i> Centros de Formacion</a>
    <a href='/programa/index'><i class="fas fa-graduation-cap"></i> Programas de Formacion</a>
</div>

<div class="data-container">
    <h2 class="form-title">Crear Nuevo Centro</h2>
    <form action="/centro/create" method="post">
        <div class="form-group">
            <label for="txtNombre">Nombre del Centro</label>
            <input type="text" name="txtNombre" id="txtNombre" placeholder="Ingrese el nombre del centro" required>
        </div>
        <div class="form-group">
            <button type="submit"><i class="fas fa-plus-circle"></i> Crear Centro</button>
        </div>
    </form>
</div>