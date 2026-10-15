<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Clínica</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="shell">
        <header class="hero">
            <div>
                <span class="eyebrow">Projeto inicial · Laravel + Blade</span>
                <h1>Agenda da clínica</h1>
                <p>Uma base funcional para evoluir durante a aula.</p>
            </div>
            <div class="date-card"><strong>{{ now()->translatedFormat('d M') }}</strong><span>{{ now()->translatedFormat('l') }}</span></div>
        </header>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        <section class="panel">
            <form method="GET" action="{{ route('appointments.index') }}" class="filters">
                <label>Data<input type="date" name="date" value="{{ $filters['date'] }}"></label>
                <label>Profissional<select name="professional"><option value="">Todos</option>@foreach ($professionals as $professional)<option value="{{ $professional->id }}" @selected((string) $professional->id === (string) $filters['professional'])>{{ $professional->name }}</option>@endforeach</select></label>
                <label>Status<select name="status"><option value="">Todos</option><option value="confirmed" @selected($filters['status'] === 'confirmed')>Confirmada</option><option value="pending" @selected($filters['status'] === 'pending')>Pendente</option><option value="cancelled" @selected($filters['status'] === 'cancelled')>Cancelada</option></select></label>
                <button type="submit">Filtrar agenda</button>
            </form>
        </section>

        <div class="grid">
            <section class="panel schedule">
                <div class="section-heading"><div><span class="eyebrow">Consultas</span><h2>{{ $appointments->count() }} horários encontrados</h2></div></div>
                <div class="appointments">
                    @forelse ($appointments as $appointment)
                        <article class="appointment">
                            <time>{{ $appointment->scheduled_at->format('H:i') }}</time>
                            <div><strong>{{ $appointment->patient_name }}</strong><span>{{ $appointment->professional->name }} · {{ $appointment->professional->specialty }}</span></div>
                            <span class="status {{ $appointment->status }}">{{ ['confirmed' => 'Confirmada', 'pending' => 'Pendente', 'cancelled' => 'Cancelada'][$appointment->status] }}</span>
                        </article>
                    @empty
                        <div class="empty">Nenhuma consulta para os filtros escolhidos.</div>
                    @endforelse
                </div>
            </section>

            <section class="panel form-panel">
                <span class="eyebrow">Novo horário</span><h2>Agendar consulta</h2>
                <form method="POST" action="{{ route('appointments.store') }}" class="stack">
                    @csrf
                    <label>Paciente<input name="patient_name" value="{{ old('patient_name') }}" placeholder="Nome completo">@error('patient_name')<small>{{ $message }}</small>@enderror</label>
                    <label>Profissional<select name="professional_id"><option value="">Selecione</option>@foreach ($professionals as $professional)<option value="{{ $professional->id }}" @selected(old('professional_id') == $professional->id)>{{ $professional->name }}</option>@endforeach</select>@error('professional_id')<small>{{ $message }}</small>@enderror</label>
                    <label>Data e hora<input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}">@error('scheduled_at')<small>{{ $message }}</small>@enderror</label>
                    <label>Status<select name="status"><option value="pending">Pendente</option><option value="confirmed">Confirmada</option></select></label>
                    <label>Observações<textarea name="notes" rows="3">{{ old('notes') }}</textarea>@error('notes')<small>{{ $message }}</small>@enderror</label>
                    <button type="submit">Criar agendamento</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
