import { router } from '@inertiajs/react';
import { FormEvent, useState } from 'react';
import type { AppointmentFilters as Filters, Professional } from '../types';

type Props = {
    filters: Filters;
    professionals: Professional[];
};

export function AppointmentFilters({ filters, professionals }: Props) {
    const [values, setValues] = useState(filters);

    function submit(event: FormEvent<HTMLFormElement>) {
        event.preventDefault();
        router.get('/agenda', values, {
            preserveState: true,
            replace: true,
        });
    }

    return (
        <section className="panel">
            <form className="filters" onSubmit={submit}>
                <label>
                    Data
                    <input type="date" value={values.date} onChange={(event) => setValues({ ...values, date: event.target.value })} />
                </label>
                <label>
                    Profissional
                    <select data-testid="professional" value={values.professional} onChange={(event) => setValues({ ...values, professional: event.target.value })}>
                        <option value="">Todos</option>
                        {professionals.map((professional) => <option key={professional.id} value={professional.id}>{professional.name}</option>)}
                    </select>
                </label>
                <label>
                    Status
                    <select data-testid="status" value={values.status} onChange={(event) => setValues({ ...values, status: event.target.value })}>
                        <option value="">Todos</option>
                        <option value="confirmed">Confirmada</option>
                        <option value="pending">Pendente</option>
                        <option value="cancelled">Cancelada</option>
                    </select>
                </label>
                <button type="submit" data-testid="button">Atualizar agenda</button>
            </form>
        </section>
    );
}
