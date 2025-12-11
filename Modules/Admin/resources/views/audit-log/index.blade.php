@extends('admin.layouts.app')

@section('css')
    <style>
        /* väčší a čistejší popover */
        .popover.modern-popover { background:#fff;border:1px solid #dee2e6;border-radius:12px;box-shadow:0 10px 28px rgba(0,0,0,.16);font-size:.92rem;max-width:720px;min-width:420px; }
        .popover.modern-popover .popover-header { background:#f8f9fa;color:#0d6efd;font-weight:600;border-bottom:1px solid #dee2e6;font-size:1rem;padding:10px 14px; }
        .popover.modern-popover .popover-body { padding:14px 16px; max-height:480px; overflow:auto; }

        .popover-kv { display:flex; flex-direction:column; gap:8px; }
        .popover-kv .kv { display:grid; grid-template-columns:160px 1fr; gap:12px; align-items:start; padding:6px 0; border-bottom:1px dashed #e9ecef; }
        .popover-kv .kv:last-child{ border-bottom:0; }
        .popover-kv .k { font-weight:600; color:#495057; word-break:break-word; }
        .popover-kv .v { color:#212529; word-break:break-word; white-space:pre-wrap; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; background:#f9fafb; border-radius:6px; padding:3px 6px; }

        /* trace */
        .trace-pre { margin:0; white-space:pre-wrap; word-break:break-word; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; background:#0f172a; color:#e2e8f0; padding:12px; border-radius:8px; }

</style>
@endsection

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">{{__('admin.leads_overview')}}</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="DataTableItemAdmin" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="text-center">{{__('admin.table.id')}}</th>
                                    <th class="text-center">{{__('admin.table.user_id')}}</th>
                                    <th class="text-center">{{__('admin.table.method')}}</th>
                                    <th class="text-center">{{__('admin.table.path')}}</th>
                                    <th class="text-center">{{__('admin.table.ip')}}</th>
                                    <th class="text-center">{{__('admin.table.error')}}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
    </div>
@endsection

@section('js')
    <script>
        $('#DataTableItemAdmin').DataTable({
            processing: true,
            serverSide: true,
            deferRender: true,
            searching: true,
            paging: true,
            ordering: true,
            pageLength: 100,
            ajax: "{{ route('admin.data-table.auditLogs') }}",
            columns: [
                { data: 'id', name: 'id', orderable: true, searchable: false },
                { data: 'user_id', name: 'user_id', orderable: true, searchable: true },
                { data: 'data', name: 'data', orderable: true, searchable: true },
                { data: 'path', name: 'path', orderable: true, searchable: true },
                { data: 'ip', name: 'ip', orderable: true, searchable: true },
                { data: 'error', name: 'error', orderable: false, searchable: true },
            ],
            "order":[[0, 'desc']]
        });
    </script>

    <script>
        (function() {
            var POP_SHOW_DELAY = 120;
            var POP_HIDE_DELAY = 220;  // trochu viac času na presun myši
            var contentCache = new Map();

            function scheduleUpdate($el) {
                var inst = $el.data('bs.popover');
                if (!inst) return;
                if (inst._popper && typeof inst._popper.scheduleUpdate === 'function') {
                    inst._popper.scheduleUpdate();
                } else if (typeof inst.update === 'function') {
                    inst.update();
                }
            }

            function ensurePopover($el) {
                if ($el.data('popoverInit')) return;
                $el.data('popoverInit', true);

                var t = $el.attr('title') || 'Detail';
                $el.attr('title', t).attr('data-original-title', t);

                $el.popover({
                    trigger: 'manual',
                    placement: 'auto',
                    container: 'body',
                    boundary: 'window',
                    html: true,
                    sanitize: false,
                    title: t,
                    content: '<div class="text-muted">Načítavam…</div>',
                    template:
                        '<div class="popover modern-popover" role="tooltip">' +
                        '<div class="arrow"></div>' +
                        '<h3 class="popover-header"></h3>' +
                        '<div class="popover-body"></div>' +
                        '</div>',
                    fallbackPlacement: ['top','bottom','right','left'],
                    offset: '0,10'
                }).on('shown.bs.popover', function(){ scheduleUpdate($el); });
            }

            function getTip$($el) {
                var inst = $el.data('bs.popover');
                if (!inst) return $();
                var tipEl = null;
                if (typeof inst.getTipElement === 'function') tipEl = inst.getTipElement(); // BS4
                else if (typeof inst.tip === 'function') tipEl = inst.tip();                // niektoré BS5 buildy
                else if (inst.tip) tipEl = inst.tip;                                       // BS5
                return tipEl ? $(tipEl) : $();
            }

            function applyContent($el, html) {
                var safe = (typeof html === 'string') ? html : '';
                $el.data('pendingContent', safe);

                var $tip = getTip$($el);
                if ($tip.length && $tip.hasClass('show')) {
                    $tip.find('.popover-body').html(safe);
                    scheduleUpdate($el);
                } else {
                    $el.one('shown.bs.popover', function() {
                        var $tip2 = getTip$($el);
                        if ($tip2.length) {
                            $tip2.find('.popover-body').html($el.data('pendingContent') || '');
                            scheduleUpdate($el);
                        }
                    });
                }
            }

            function showWithIntent(el) {
                var $el = $(el);
                clearTimeout($el.data('hideTimer'));

                var showTimer = setTimeout(function() {
                    ensurePopover($el);

                    var url = $el.attr('data-popover-url');
                    if (!url) return;

                    if (contentCache.has(url)) {
                        applyContent($el, contentCache.get(url)); // priprav obsah ešte pred show
                    }

                    $el.popover('show'); // otvor
                    // (už neviažeme per-popover hover – rieši to globál handler nižšie)

                    if (!contentCache.has(url) && !$el.data('loading')) {
                        $el.data('loading', true);
                        $.get(url)
                            .done(function(html){
                                contentCache.set(url, html);
                                applyContent($el, html); // dosadí okamžite, ak je otvorený
                            })
                            .fail(function(){
                                applyContent($el, '<div class="text-danger">Nepodarilo sa načítať.</div>');
                            })
                            .always(function(){
                                $el.data('loading', false);
                            });
                    }
                }, POP_SHOW_DELAY);

                $el.data('showTimer', showTimer);
            }

            function hideWithIntent(el) {
                var $el = $(el);
                clearTimeout($el.data('showTimer'));

                var hideTimer = setTimeout(function() {
                    var descId = $el.attr('aria-describedby');
                    var $pop = descId ? $('#' + descId) : $();
                    if (!$pop.length || !$pop.is(':hover')) {
                        $el.popover('hide');
                    }
                }, POP_HIDE_DELAY);

                $el.data('hideTimer', hideTimer);
            }

            // Delegované udalosti na triggery (ikonky)
            $(document)
                .on('mouseenter', '.hover-pop', function(){ showWithIntent(this); })
                .on('mouseleave', '.hover-pop', function(){ hideWithIntent(this); });

            // GLOBÁLNE handlery pre samotný popover – odstránia prebliknutie/race
            $(document)
                .on('mouseenter', '.popover', function(){
                    var $trigger = $('[aria-describedby="' + this.id + '"]');
                    clearTimeout($trigger.data('hideTimer'));
                })
                .on('mouseleave', '.popover', function(){
                    var $trigger = $('[aria-describedby="' + this.id + '"]');
                    if ($trigger.length) hideWithIntent($trigger[0]);
                });

            // Prepočet pri scroll/resize
            $(window).on('scroll resize', function() {
                $('.hover-pop[aria-describedby]').each(function(){ scheduleUpdate($(this)); });
            });
        })();

    </script>



@endsection
