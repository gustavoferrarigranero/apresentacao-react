import { useForm } from '@inertiajs/react';
import { FormEvent } from 'react';
import type { AppointmentStatus, Professional } from '../types';

type Props = {
    professionals: Professional[];
};

type AppointmentFormData = {
    patient_name: string;
    professional_id: string;
    scheduled_at: string;
    status: AppointmentStatus;
    notes: string;
};

export function AppointmentForm({ professionals }: Props) {
    const { data, setData, post, processing, errors, reset } = useForm<AppointmentFormData>({
        patient_name: '',
        professional_id: '',
        scheduled_at: '',
        status: 'pending',
        notes: '',
    });

    function submit(event: FormEvent<HTMLFormElement>) {
        event.preventDefault();
        post('/agenda', {
            preserveScroll: true,
            onSuccess: () => reset(),
        });
    }

    return (
        <section className="panel form-panel">
            <span className="eyebrow">Novo horário</span>
            <h2>Agendar consulta</h2>
            <form className="stack" onSubmit={submit}>
                <label>
                    Paciente
                    <input value={data.patient_name} onChange={(event) => setData('patient_name', event.target.value)} placeholder="Nome completo" />
                    {errors.patient_name && <small>{errors.patient_name}</small>}
                </label>
                <label>
                    Profissional
                    <select value={data.professional_id} onChange={(event) => setData('professional_id', event.target.value)}>
                        <option value="">Selecione</option>
                        {professionals.map((professional) => <option key={professional.id} value={professional.id}>{professional.name}</option>)}
                    </select>
                    {errors.professional_id && <small>{errors.professional_id}</small>}
                </label>
                <label>
                    Data e hora
                    <input type="datetime-local" value={data.scheduled_at} onChange={(event) => setData('scheduled_at', event.target.value)} />
                    {errors.scheduled_at && <small>{errors.scheduled_at}</small>}
                </label>
                <label>
                    Status
                    <select value={data.status} onChange={(event) => setData('status', event.target.value as AppointmentStatus)}>
                        <option value="pending">Pendente</option>
                        <option value="confirmed">Confirmada</option>
                    </select>
                    {errors.status && <small>{errors.status}</small>}
                </label>
                <label>
                    Observações
                    <textarea rows={3} value={data.notes} onChange={(event) => setData('notes', event.target.value)} />
                    {errors.notes && <small>{errors.notes}</small>}
                </label>
                <button type="submit" disabled={processing}>{processing ? 'Agendando…' : 'Criar agendamento'}</button>
            </form>
        </section>
    );
}
