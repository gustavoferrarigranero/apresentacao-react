import { Head } from '@inertiajs/react';
import type { AppointmentPageProps } from '../../Features/Appointments/types';
import {AppointmentFilters} from "../../Features/Appointments/components/AppointmentFilters";

export default function Index({ filters, professionals, flash }: AppointmentPageProps) {
    return (
        <>
            <Head title="Agenda da clínica" />
            <main className="shell">
              <header className="hero">
                <div>
                  <h1>Agenda da clínica</h1>
                </div>
                <div className="tech-card">
                  <strong>React</strong>
                  <span>UI interativa</span>
                </div>
              </header>
              {flash.success && <div className="alert success">{flash.success}</div>}
              <AppointmentFilters filters={filters} professionals={professionals} />
            </main>
        </>
    );
}
