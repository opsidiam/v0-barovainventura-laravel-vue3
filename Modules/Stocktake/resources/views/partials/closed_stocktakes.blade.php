@foreach($stocktakes as $stocktake)
    @if($stocktake->ready)
        <tr>
            <td>{{$stocktake->name_formated}}</td>
            <td class="text-center">{{$stocktake->scan_history_count}}</td>
            <td class="text-center">{{$stocktake->created_formated}}</td>
            <td class="text-center"><strong>{{$stocktake->expire_formated}}</strong></td>
            <td style="width: 120px" class="text-right">
                <!-- Dropdown pre export -->
                <div class="dropdown d-inline-block mr-2">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                            id="exportDropdown_{{$stocktake->id}}" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-download fa-sm mr-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                         aria-labelledby="exportDropdown_{{$stocktake->id}}">
                        <div class="dropdown-header small font-weight-bold text-uppercase text-muted">Export dát</div>
                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('stocktake.export', ['id' => $stocktake->id, 'type' => 'excel']) }}">
                            <i class="fas fa-file-excel text-success mr-2 fa-fw" style="width: 1.25rem;"></i>
                            <span>Excel</span>
                        </a>
                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('stocktake.export', ['id' => $stocktake->id, 'type' => 'pdf']) }}">
                            <i class="fas fa-file-pdf text-danger mr-2 fa-fw" style="width: 1.25rem;"></i>
                            <span>PDF</span>
                        </a>
                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('stocktake.export', ['id' => $stocktake->id, 'type' => 'csv']) }}">
                            <i class="fas fa-file-csv text-primary mr-2 fa-fw" style="width: 1.25rem;"></i>
                            <span>CSV</span>
                        </a>
                    </div>
                </div>
            </td>
        </tr>
    @else
        <!-- Riadok s rozmazaným obsahom a prekrytím -->
        <tr class="processing-row">
            <td class="position-relative">
                <div class="blur-content">{{$stocktake->name_formated}}</div>
                <div class="processing-overlay font-weight-bold text-danger">
                    <i class="fas fa-spinner fa-spin mr-2"></i>
                    Systém spracúva dáta z inventúry
                </div>
            </td>
            <td class="position-relative text-center">
                <div class="blur-content">{{$stocktake->scan_history_count}}</div>
                <div class="processing-overlay"></div>
            </td>
            <td class="position-relative text-center">
                <div class="blur-content">{{$stocktake->created_formated}}</div>
                <div class="processing-overlay"></div>
            </td>
            <td class="position-relative text-center">
                <div class="blur-content"><strong>{{$stocktake->expire_formated}}</strong></div>
                <div class="processing-overlay"></div>
            </td>
            <td class="position-relative text-right" style="width: 120px">
                <div class="blur-content">
                    <i class="fas fa-download fa-sm mr-1"></i>
                </div>
                <div class="processing-overlay"></div>
            </td>
        </tr>
    @endif
@endforeach
