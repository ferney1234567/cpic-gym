// Dashboard JavaScript
class GymDashboard {
    constructor() {
        this.currentSection = 'dashboard';
        this.members = [];
        this.classes = [];
        this.equipment = [];
        this.payments = [];
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.loadSampleData();
        this.updateStats();
        this.renderActivities();
        this.createChart();
        this.showSection('dashboard');
    }

    setupEventListeners() {
        // Navigation
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const section = e.currentTarget.dataset.section;
                this.showSection(section);
            });
        });

        // Mobile menu toggle
        const menuToggle = document.querySelector('.menu-toggle');
        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                document.querySelector('.sidebar').classList.toggle('open');
            });
        }

        // Modal events
        document.getElementById('memberForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.addMember();
        });

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal')) {
                e.target.style.display = 'none';
            }
        });
    }

    showSection(sectionName) {
        // Update navigation
        document.querySelectorAll('.nav-item').forEach(item => {
            item.classList.remove('active');
        });
        document.querySelector(`[data-section="${sectionName}"]`).parentNode.classList.add('active');

        // Update content
        document.querySelectorAll('.content-section').forEach(section => {
            section.classList.remove('active');
        });
        document.getElementById(`${sectionName}-section`).classList.add('active');

        // Update page title
        const titles = {
            dashboard: 'Dashboard',
            members: 'Gestión de Miembros',
            classes: 'Horario de Clases',
            equipment: 'Equipamiento',
            payments: 'Gestión de Pagos'
        };
        document.getElementById('page-title').textContent = titles[sectionName];

        this.currentSection = sectionName;

        // Load section-specific data
        switch(sectionName) {
            case 'members':
                this.renderMembers();
                break;
            case 'classes':
                this.renderSchedule();
                break;
            case 'equipment':
                this.renderEquipment();
                break;
            case 'payments':
                this.renderPayments();
                break;
        }
    }

    loadSampleData() {
        // Sample members data
        this.members = [
            { id: 1, name: 'Juan Pérez', email: 'juan@email.com', phone: '123-456-7890', plan: 'Premium', status: 'Activo', joinDate: '2024-01-15' },
            { id: 2, name: 'María García', email: 'maria@email.com', phone: '098-765-4321', plan: 'Básico', status: 'Activo', joinDate: '2024-02-01' },
            { id: 3, name: 'Carlos López', email: 'carlos@email.com', phone: '555-123-4567', plan: 'VIP', status: 'Inactivo', joinDate: '2024-01-20' },
            { id: 4, name: 'Ana Rodríguez', email: 'ana@email.com', phone: '777-888-9999', plan: 'Premium', status: 'Activo', joinDate: '2024-03-10' },
            { id: 5, name: 'Pedro Martínez', email: 'pedro@email.com', phone: '111-222-3333', plan: 'Básico', status: 'Activo', joinDate: '2024-02-15' }
        ];

        // Sample classes data
        this.classes = [
            { id: 1, name: 'Yoga Matutino', instructor: 'Laura Silva', time: '07:00', duration: 60, day: 'Lunes', capacity: 20, enrolled: 15 },
            { id: 2, name: 'CrossFit', instructor: 'Miguel Torres', time: '18:00', duration: 45, day: 'Lunes', capacity: 15, enrolled: 12 },
            { id: 3, name: 'Pilates', instructor: 'Carmen López', time: '10:00', duration: 50, day: 'Martes', capacity: 18, enrolled: 16 },
            { id: 4, name: 'Spinning', instructor: 'Roberto Díaz', time: '19:00', duration: 45, day: 'Miércoles', capacity: 25, enrolled: 22 },
            { id: 5, name: 'Zumba', instructor: 'Sofia Herrera', time: '20:00', duration: 60, day: 'Jueves', capacity: 30, enrolled: 28 }
        ];

        // Sample equipment data
        this.equipment = [
            { id: 1, name: 'Cinta de Correr Pro', type: 'Cardio', status: 'Disponible', lastMaintenance: '2024-01-15', nextMaintenance: '2024-04-15' },
            { id: 2, name: 'Banco de Pesas', type: 'Fuerza', status: 'Disponible', lastMaintenance: '2024-02-01', nextMaintenance: '2024-05-01' },
            { id: 3, name: 'Bicicleta Estática', type: 'Cardio', status: 'Mantenimiento', lastMaintenance: '2024-03-01', nextMaintenance: '2024-03-15' },
            { id: 4, name: 'Máquina de Remo', type: 'Cardio', status: 'Disponible', lastMaintenance: '2024-01-20', nextMaintenance: '2024-04-20' },
            { id: 5, name: 'Rack de Sentadillas', type: 'Fuerza', status: 'Fuera de Servicio', lastMaintenance: '2024-02-15', nextMaintenance: '2024-03-20' }
        ];

        // Sample payments data
        this.payments = [
            { id: 1, member: 'Juan Pérez', amount: 50, date: '2024-03-01', method: 'Tarjeta', status: 'Completado' },
            { id: 2, member: 'María García', amount: 30, date: '2024-03-02', method: 'Efectivo', status: 'Completado' },
            { id: 3, member: 'Carlos López', amount: 80, date: '2024-03-03', method: 'Transferencia', status: 'Pendiente' },
            { id: 4, member: 'Ana Rodríguez', amount: 50, date: '2024-03-04', method: 'Tarjeta', status: 'Completado' },
            { id: 5, member: 'Pedro Martínez', amount: 30, date: '2024-03-05', method: 'Efectivo', status: 'Completado' }
        ];
    }

    updateStats() {
        // Update dashboard statistics
        document.getElementById('total-members').textContent = this.members.filter(m => m.status === 'Activo').length;
        document.getElementById('classes-today').textContent = this.getTodayClasses();
        document.getElementById('monthly-revenue').textContent = `$${this.getMonthlyRevenue()}`;
        document.getElementById('equipment-count').textContent = this.equipment.filter(e => e.status === 'Disponible').length;
    }

    getTodayClasses() {
        const today = new Date().toLocaleDateString('es-ES', { weekday: 'long' });
        const todaySpanish = this.translateDay(today);
        return this.classes.filter(c => c.day === todaySpanish).length;
    }

    translateDay(day) {
        const dayMap = {
            'Monday': 'Lunes',
            'Tuesday': 'Martes',
            'Wednesday': 'Miércoles',
            'Thursday': 'Jueves',
            'Friday': 'Viernes',
            'Saturday': 'Sábado',
            'Sunday': 'Domingo'
        };
        return dayMap[day] || day;
    }

    getMonthlyRevenue() {
        const currentMonth = new Date().getMonth();
        return this.payments
            .filter(p => new Date(p.date).getMonth() === currentMonth && p.status === 'Completado')
            .reduce((sum, p) => sum + p.amount, 0);
    }

    renderActivities() {
        const activitiesList = document.getElementById('activities-list');
        const activities = [
            { icon: 'user-plus', text: 'Nuevo miembro registrado: Ana Rodríguez', time: 'Hace 2 horas' },
            { icon: 'credit-card', text: 'Pago recibido de Juan Pérez', time: 'Hace 3 horas' },
            { icon: 'calendar-check', text: 'Clase de Yoga completada', time: 'Hace 5 horas' },
            { icon: 'tools', text: 'Mantenimiento programado para Bicicleta Estática', time: 'Hace 1 día' },
            { icon: 'users', text: 'Nuevo record de asistencia diaria', time: 'Hace 2 días' }
        ];

        activitiesList.innerHTML = activities.map(activity => `
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-${activity.icon}"></i>
                </div>
                <div class="activity-info">
                    <p class="activity-text">${activity.text}</p>
                    <p class="activity-time">${activity.time}</p>
                </div>
            </div>
        `).join('');
    }

    createChart() {
        const canvas = document.getElementById('attendanceChart');
        const ctx = canvas.getContext('2d');
        
        // Simple chart implementation
        canvas.width = 400;
        canvas.height = 200;
        
        const data = [65, 59, 80, 81, 56, 55, 40];
        const labels = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];
        
        // Clear canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        // Chart styling
        const barWidth = 40;
        const maxHeight = 150;
        const maxValue = Math.max(...data);
        
        // Draw bars
        data.forEach((value, index) => {
            const x = index * (barWidth + 10) + 30;
            const height = (value / maxValue) * maxHeight;
            const y = canvas.height - height - 30;
            
            // Create gradient
            const gradient = ctx.createLinearGradient(0, y, 0, y + height);
            gradient.addColorStop(0, '#667eea');
            gradient.addColorStop(1, '#764ba2');
            
            ctx.fillStyle = gradient;
            ctx.fillRect(x, y, barWidth, height);
            
            // Draw labels
            ctx.fillStyle = '#333';
            ctx.font = '12px sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText(labels[index], x + barWidth/2, canvas.height - 10);
            ctx.fillText(value, x + barWidth/2, y - 5);
        });
    }

    renderMembers() {
        const tbody = document.getElementById('members-tbody');
        tbody.innerHTML = this.members.map(member => `
            <tr>
                <td>${member.id}</td>
                <td>${member.name}</td>
                <td>${member.email}</td>
                <td>${member.phone}</td>
                <td><span class="badge badge-info">${member.plan}</span></td>
                <td><span class="badge ${member.status === 'Activo' ? 'badge-success' : 'badge-danger'}">${member.status}</span></td>
                <td>
                    <div class="action-buttons">
                        <button class="btn btn-sm btn-view" onclick="dashboard.viewMember(${member.id})">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-edit" onclick="dashboard.editMember(${member.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-delete" onclick="dashboard.deleteMember(${member.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    renderSchedule() {
        const scheduleGrid = document.getElementById('schedule-grid');
        const days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        
        scheduleGrid.innerHTML = days.map(day => {
            const dayClasses = this.classes.filter(c => c.day === day);
            return `
                <div class="schedule-day">
                    <h4>${day}</h4>
                    ${dayClasses.map(cls => `
                        <div class="class-item">
                            <strong>${cls.name}</strong><br>
                            ${cls.time} - ${cls.instructor}<br>
                            ${cls.enrolled}/${cls.capacity} inscritos
                        </div>
                    `).join('')}
                </div>
            `;
        }).join('');
    }

    renderEquipment() {
        const equipmentGrid = document.getElementById('equipment-grid');
        equipmentGrid.innerHTML = this.equipment.map(equipment => `
            <div class="equipment-card">
                <h4>${equipment.name}</h4>
                <p><strong>Tipo:</strong> ${equipment.type}</p>
                <p><strong>Estado:</strong> 
                    <span class="equipment-status ${this.getEquipmentStatusClass(equipment.status)}">
                        ${equipment.status}
                    </span>
                </p>
                <p><strong>Último Mantenimiento:</strong> ${equipment.lastMaintenance}</p>
                <p><strong>Próximo Mantenimiento:</strong> ${equipment.nextMaintenance}</p>
                <div class="action-buttons" style="margin-top: 15px;">
                    <button class="btn btn-sm btn-edit" onclick="dashboard.editEquipment(${equipment.id})">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn btn-sm btn-view" onclick="dashboard.scheduleMaintenence(${equipment.id})">
                        <i class="fas fa-tools"></i> Mantenimiento
                    </button>
                </div>
            </div>
        `).join('');
    }

    getEquipmentStatusClass(status) {
        switch(status) {
            case 'Disponible': return 'status-available';
            case 'Mantenimiento': return 'status-maintenance';
            case 'Fuera de Servicio': return 'status-out-of-order';
            default: return '';
        }
    }

    renderPayments() {
        const tbody = document.getElementById('payments-tbody');
        tbody.innerHTML = this.payments.map(payment => `
            <tr>
                <td>${payment.id}</td>
                <td>${payment.member}</td>
                <td>$${payment.amount}</td>
                <td>${payment.date}</td>
                <td>${payment.method}</td>
                <td><span class="badge ${payment.status === 'Completado' ? 'badge-success' : 'badge-warning'}">${payment.status}</span></td>
                <td>
                    <div class="action-buttons">
                        <button class="btn btn-sm btn-view" onclick="dashboard.viewPayment(${payment.id})">
                            <i class="fas fa-eye"></i>
                        </button>
                        ${payment.status === 'Pendiente' ? `
                            <button class="btn btn-sm btn-edit" onclick="dashboard.processPayment(${payment.id})">
                                <i class="fas fa-check"></i> Procesar
                            </button>
                        ` : ''}
                    </div>
                </td>
            </tr>
        `).join('');
    }

    // Modal functions
    openMemberModal() {
        document.getElementById('memberModal').style.display = 'block';
    }

    closeMemberModal() {
        document.getElementById('memberModal').style.display = 'none';
        document.getElementById('memberForm').reset();
    }

    addMember() {
        const form = document.getElementById('memberForm');
        const formData = new FormData(form);
        
        const newMember = {
            id: this.members.length + 1,
            name: formData.get('name'),
            email: formData.get('email'),
            phone: formData.get('phone'),
            plan: formData.get('plan'),
            status: 'Activo',
            joinDate: new Date().toISOString().split('T')[0]
        };

        this.members.push(newMember);
        this.closeMemberModal();
        
        if (this.currentSection === 'members') {
            this.renderMembers();
        }
        
        this.updateStats();
        this.showNotification('Miembro agregado exitosamente', 'success');
    }

    // Action functions
    viewMember(id) {
        const member = this.members.find(m => m.id === id);
        if (member) {
            alert(`Información del miembro:\n\nNombre: ${member.name}\nEmail: ${member.email}\nTeléfono: ${member.phone}\nPlan: ${member.plan}\nEstado: ${member.status}\nFecha de Ingreso: ${member.joinDate}`);
        }
    }

    editMember(id) {
        this.showNotification('Función de edición en desarrollo', 'info');
    }

    deleteMember(id) {
        if (confirm('¿Está seguro de que desea eliminar este miembro?')) {
            this.members = this.members.filter(m => m.id !== id);
            this.renderMembers();
            this.updateStats();
            this.showNotification('Miembro eliminado exitosamente', 'success');
        }
    }

    editEquipment(id) {
        this.showNotification('Función de edición de equipamiento en desarrollo', 'info');
    }

    scheduleMaintenence(id) {
        this.showNotification('Mantenimiento programado exitosamente', 'success');
    }

    viewPayment(id) {
        const payment = this.payments.find(p => p.id === id);
        if (payment) {
            alert(`Información del pago:\n\nMiembro: ${payment.member}\nMonto: $${payment.amount}\nFecha: ${payment.date}\nMétodo: ${payment.method}\nEstado: ${payment.status}`);
        }
    }

    processPayment(id) {
        const payment = this.payments.find(p => p.id === id);
        if (payment) {
            payment.status = 'Completado';
            this.renderPayments();
            this.updateStats();
            this.showNotification('Pago procesado exitosamente', 'success');
        }
    }

    openClassModal() {
        this.showNotification('Modal de nueva clase en desarrollo', 'info');
    }

    openEquipmentModal() {
        this.showNotification('Modal de nuevo equipamiento en desarrollo', 'info');
    }

    openPaymentModal() {
        this.showNotification('Modal de nuevo pago en desarrollo', 'info');
    }

    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${this.getNotificationIcon(type)}"></i>
                <span>${message}</span>
            </div>
        `;

        // Add styles for notification
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 3000;
            animation: slideInRight 0.3s ease;
            background: ${this.getNotificationColor(type)};
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        `;

        document.body.appendChild(notification);

        // Remove notification after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    getNotificationIcon(type) {
        const icons = {
            success: 'check-circle',
            error: 'exclamation-circle',
            warning: 'exclamation-triangle',
            info: 'info-circle'
        };
        return icons[type] || 'info-circle';
    }

    getNotificationColor(type) {
        const colors = {
            success: '#28a745',
            error: '#dc3545',
            warning: '#ffc107',
            info: '#17a2b8'
        };
        return colors[type] || '#17a2b8';
    }
}

// Global functions for HTML onclick events
function openMemberModal() {
    dashboard.openMemberModal();
}

function closeMemberModal() {
    dashboard.closeMemberModal();
}

function openClassModal() {
    dashboard.openClassModal();
}

function openEquipmentModal() {
    dashboard.openEquipmentModal();
}

function openPaymentModal() {
    dashboard.openPaymentModal();
}

// Add notification animations to CSS
const style = document.createElement('style');
style.textContent = `
    .notification-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.dashboard = new GymDashboard();
});