@extends('admin.layout')

@section('header')
    <h1>Dashboard
        <small>Metricas</small></h1>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ventas/Mes</h3>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <div id="chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <form action="{{ route('admin.reports.store') }}" method="POST">
                @CSRF
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Reportes</h3>
                    </div>
                    <div class="box-body">
                        <div class="">
                            <div class="form-group {{ $errors->has('report_type') ? 'has-error' : ''}}">
                                <label>Seleccione el tipo de reporte</label>
                                <select name="report_type" class="form-control">
                                    <option class="disabled hidden" value="">Tipo de reporte</option>
                                    @foreach(PlatformReports::TYPES as $value)
                                        <option value="{{ $value }}"
                                            {{ old('report_type') == $value ? 'selected' : ''}}
                                        >@lang($value)</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('report_type', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('from_date') ? 'has-error' : ''}}">
                                <label>Desde</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="from_date"
                                           type="text"
                                           class="form-control pull-right"
                                           id="datepicker"
                                           value="{{ old('from_date') }}"
                                    >
                                </div>
                                {!! $errors->first('from_date', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('until_date') ? 'has-error' : ''}}">
                                <label>Hasta</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="until_date"
                                           type="text"
                                           class="form-control pull-right"
                                           id="datepicker1"
                                           value="{{ old('until_date') }}"
                                    >
                                </div>
                                {!! $errors->first('until_date', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-block btn-primary">Generar Reporte</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('sales_chart')",
            hooks: new ChartisanHooks()
                .colors(['#4299E1'])
                .datasets([
                    {type: 'line', fill: true}
                ])
        });
    </script>
    <script src="/adminlte/plugins/select2/select2.full.min.js"></script>
    <script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script>
        $('.select2').select2();
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        });
        $('#datepicker1').datepicker({
            autoclose: true
        });
    </script>
@endpush



