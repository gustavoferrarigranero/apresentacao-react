import { Head } from '@inertiajs/react';
import { AppointmentFilters } from '../../Features/Appointments/components/AppointmentFilters';
import { AppointmentForm } from '../../Features/Appointments/components/AppointmentForm';
import { AppointmentList } from '../../Features/Appointments/components/AppointmentList';
import type { AppointmentPageProps } from '../../Features/Appointments/types';

export default function Index({ appointments, professionals, filters, flash }: AppointmentPageProps) {
    return (
        <>
            <Head title="Agenda da clínica" />
            <main className="shell">
                <header className="hero">
                    <div>
                        <span className="eyebrow">Projeto final · Inertia + React + TypeScript</span>
                        <h1>Agenda da clínica</h1>
                        <p>Filtros reativos, contratos tipados e regras de negócio no Laravel.</p>
                    </div>
                    <div className="tech-card"><strong>React</strong><span>UI interativa</span></div>
                </header>
                {flash.success && <div className="alert success">{flash.success}</div>}
                <AppointmentFilters filters={filters} professionals={professionals} />
                <div className="grid">
                    <AppointmentList appointments={appointments} />
                    <AppointmentForm professionals={professionals} />
                </div>
            </main>
        </>
    );
}
