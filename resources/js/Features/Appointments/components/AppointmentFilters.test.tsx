import {render, screen} from '@testing-library/react';
import {describe, expect, it} from 'vitest';
import {AppointmentFilters} from './AppointmentFilters';
import {userEvent} from "@testing-library/user-event";

describe('AppointmentFilters', () => {
  it('renders the appointment filter', async () => {

    const filters = {
      date: '2026-10-14',
      professional: '1',
      status: 'confirmed',
    };

    const professionals = [
      {id: 1, name: 'Dra. Teste', specialty: 'Clinica'},
    ];

    render(<AppointmentFilters filters={filters} professionals={professionals}/>);

    expect(screen.getByText('Atualizar agenda')).toBeInTheDocument();

    const status = screen.getByTestId('status');
    const professional = screen.getByTestId('professional');


    expect(professional).toBeInTheDocument();
    expect(status).toBeInTheDocument();

    expect(status.value).toBe('confirmed');
    expect(professional.value).toBe('1');

    const fnTest = vi.fn();

    professional.onclick = fnTest;
    await userEvent.click(professional);
    expect(fnTest).toHaveBeenCalled();

  });
});