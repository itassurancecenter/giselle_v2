@extends('layout.main')
@section('judul')
DASHBOARD
@endsection

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <h5><strong>Overview Jumlah</strong></h5>
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $ticket }}</h3>

                    <p>Total Tiket</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>

            <div class="row">
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>3</h3>

                            <p>Total Tiket OGP</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>3</h3>

                            <p>Total Tiket Selesai</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $document_sm }}<sup style="font-size: 20px"></h3>

                    <p>Total Dokumen Sirkulir SM ASC</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <div class="row">
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>4</h3>

                            <p>Total Dokumen OGP <br>Sirkulir SM ASC</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>3</h3>

                            <p>Total Dokumen Selesai <br>Sirkulir SM ASC</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $document_mgr }}<sup style="font-size: 20px"></h3>

                    <p>Total Dokumen Sirkulir Mgr ASC</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <div class="row">
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>3</h3>

                            <p>Total Dokumen OGP <br>Sirkulir Mgr ASC</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>1</h3>

                            <p>Total Dokumen Selesai <br> Sirkulir Mgr ASC</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h5><strong>Grafik</strong></h5>
    <!-- /.row -->
    <!-- /.row (main row) -->
</div>
@endsection
