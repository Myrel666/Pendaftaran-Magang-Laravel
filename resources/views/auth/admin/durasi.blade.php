@extends('layouts.app')

@section('title', 'Montern')

@section('content')
<div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-4">
            <div class="col-sm-6">
              <h1 class="m-0">Pengaturan Durasi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Pengaturan Durasi</a></li>
                <li class="breadcrumb-item active">Pendaftaran Magang</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Durasi</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th>Durasi</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1.</td>
                        <td>1 Bulan</td>
                        <td>
                            <div class="switch">
                                <div class="toggle-1-bulan"></div>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                      </label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>3 Bulan</td>
                        <td>
                            <div class="switch">
                                <div class="toggle-3-bulan"></div>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                      </label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>6 Bulan</td>
                        <td>
                            <div class="switch">
                                <div class="toggle-6-bulan"></div>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                      </label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
                <!-- /.card-body -->
                            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    </section>
</div>
@endsection