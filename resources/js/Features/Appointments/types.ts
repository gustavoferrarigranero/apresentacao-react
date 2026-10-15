export type AppointmentStatus = 'confirmed' | 'pending' | 'cancelled';

export type Professional = {
    id: number;
    name: string;
    specialty: string;
};

export type Appointment = {
    id: number;
    patientName: string;
    scheduledAt: string;
    time: string;
    status: AppointmentStatus;
    notes: string | null;
    professional: Professional;
};

export type AppointmentFilters = {
    date: string;
    professional: string;
    status: string;
};

export type AppointmentPageProps = {
    appointments: Appointment[];
    professionals: Professional[];
    filters: AppointmentFilters;
    flash: {
        success?: string;
    };
};
