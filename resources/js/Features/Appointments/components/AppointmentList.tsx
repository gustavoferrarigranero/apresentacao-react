import type { Appointment } from '../types';

const statusLabels = {
    confirmed: 'Confirmada',
    pending: 'Pendente',
    cancelled: 'Cancelada',
};

type Props = {
    appointments: Appointment[];
};

export function AppointmentList({ appointments }: Props) {
    return (
        <section className="panel schedule">
            <div className="section-heading">
                <div>
                    <span className="eyebrow">Consultas</span>
                    <h2>{appointments.length} horários encontrados</h2>
                </div>
            </div>
            <div className="appointments">
                {appointments.length === 0 && <div className="empty">Nenhuma consulta para os filtros escolhidos.</div>}
                {appointments.map((appointment) => (
                    <article className="appointment" key={appointment.id}>
                        <time dateTime={appointment.scheduledAt}>{appointment.time}</time>
                        <div>
                            <strong>{appointment.patientName}</strong>
                            <span>{appointment.professional.name} · {appointment.professional.specialty}</span>
                        </div>
                        <span className={`status ${appointment.status}`}>{statusLabels[appointment.status]}</span>
                    </article>
                ))}
            </div>
        </section>
    );
}
