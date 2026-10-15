import { render, screen } from '@testing-library/react';
import { describe, expect, it } from 'vitest';
import { AppointmentList } from './AppointmentList';

describe('AppointmentList', () => {
    it('renders the appointment count and backend data', () => {
        render(
            <AppointmentList
                appointments={[{
                    id: 1,
                    patientName: 'Mariana Alves',
                    scheduledAt: '2026-10-14T09:00:00+01:00',
                    time: '09:00',
                    status: 'confirmed',
                    notes: null,
                    professional: { id: 1, name: 'Dra. Ana Costa', specialty: 'Clínica Geral' },
                }]}
            />,
        );

        expect(screen.getByText('1 horários encontrados')).toBeInTheDocument();
        expect(screen.getByText('Mariana Alves')).toBeInTheDocument();
        expect(screen.getByText('Confirmada')).toBeInTheDocument();
    });

    it('renders an empty state', () => {
        render(<AppointmentList appointments={[]} />);

        expect(screen.getByText('Nenhuma consulta para os filtros escolhidos.')).toBeInTheDocument();
    });
});
