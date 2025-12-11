<?php

namespace Modules\Admin\Services;

use App\Models\AppLog;
use App\Models\User;
use Modules\Admin\Models\AuditLog;
use Modules\Admin\Models\Lead;
use Modules\Admin\Models\Partner;
use Modules\Admin\Models\PotentialCustomer;
use Modules\Cargo\Models\Cargo;
use Modules\Newsletter\Models\Newsletter;
use Modules\User\Models\Support;
use Yajra\DataTables\DataTables;

class AdminDataTableService
{
    public function handle() {}

    public function approvedProducts()
    {
        $item = Cargo::orderBy('id', 'desc')->where('original',0);

        return DataTables::of($item)
            ->addIndexColumn()
            ->editColumn('name', function ($item) {
                return view('admin::approved-products.datatable.item', compact('item'))->render();
            })
            ->editColumn('type', function ($item) {
                return $item->type? __('warehouse.type.unspilled'):__('warehouse.type.spilled');
            })
            ->editColumn('action', function ($item) {
                // set route prefix for system Customers
                return view('admin::approved-products.datatable.action', compact('item'))->render();
            })
            ->rawColumns(['name','action'])
            ->make();
    }

    public function unapprovedProducts()
    {
        $item = Cargo::orderBy('id', 'desc')->where('original','!=',0);

        return DataTables::of($item)
            ->addIndexColumn()
            ->editColumn('name', function ($item) {
                return view('admin::unapproved-products.datatable.item', compact('item'))->render();
            })
            ->editColumn('type', function ($item) {
                return $item->type? __('warehouse.type.unspilled'):__('warehouse.type.spilled');
            })
            ->editColumn('action', function ($item) {
                // set route prefix for system Customers
                return view('admin::unapproved-products.datatable.action', compact('item'))->render();
            })
            ->rawColumns(['name','action'])
            ->make();
    }

    public function support()
    {
        $item = Support::orderBy('id', 'desc')->select('*');

        return DataTables::of($item)
            ->addIndexColumn()
            ->editColumn('name', function ($item) {
                return ($item->name ?? null) . ' ' . ($item->surname ?? null);
            })
            ->editColumn('created_at', function ($item) {
                return $item->created_at? $item->created_at->format(config('system.datetime_format')): null;
            })
            ->editColumn('status', function ($item) {
                return $item->status? '<b style="color: #656565">' . __('app.support_close') . '</b>' : '<b style="color: #00ad17">' . __('app.support_open') . '</b>';
            })
            ->editColumn('action', function ($item) {
                return view('admin::support.datatable.action', compact('item'))->render();
            })
            ->rawColumns(['status','action'])
            ->make();
    }

    public function users()
    {
        $user = User::orderBy('id', 'desc')->select('*');
        return DataTables::of($user)
            ->addIndexColumn()
            ->editColumn('name', function ($user) {
                return view('admin::users.datatable.item', compact('user'))->render();
            })
            ->editColumn('email', function ($user) {
                return $user->email ?? '';
            })
            ->editColumn('licence_expire', function ($user) {
                return $user->licence_expire? $user->licence_expire->format(config('system.datetime_format')): null;
            })
            ->editColumn('created_at', function ($user) {
                return view('admin::users.datatable.created_at', compact('user'))->render();
            })
            ->editColumn('action', function ($user) {
                return view('admin::users.datatable.action', compact('user'))->render();
            })
            ->rawColumns(['name','action','created_at'])
            ->make();
    }

    public function partners()
    {
        $q = Partner::query()->orderByDesc('id');

        return DataTables::of($q)
            ->addIndexColumn()

            ->addColumn('name', function (Partner $p) {
                $full = trim($p->first_name . ' ' . $p->last_name);
                $company = $p->company ? '<br><small class="text-muted">Firma: '.e($p->company).'</small>' : '';
                $url = route('admin.partners.show', $p->id);
                return '<a href="'.e($url).'"><strong>'.e($full).'</strong></a>'.$company;
            })

            ->editColumn('email', function (Partner $p) {
                return $p->email ? '<a href="mailto:'.e($p->email).'">'.e($p->email).'</a>' : '—';
            })

            ->addColumn('created_at', function (Partner $p) {
                return $p->created_at?->format(config('system.datetime_format', 'Y-m-d H:i'));
            })

            ->addColumn('action', function (Partner $p) {
                $show = route('admin.partners.show', $p->id);
                $edit = route('admin.partners.edit', $p->id);
                $del  = route('admin.partners.destroy', $p->id);

                return '
                <div class="btn-group" role="group">
                  <a href="'.e($show).'" class="btn btn-sm btn-outline-secondary">
                      <i class="fas fa-eye"></i>
                  </a>
                  <a href="'.e($edit).'" class="btn btn-sm btn-outline-primary">
                      <i class="fas fa-edit"></i>
                  </a>
                  <form action="'.e($del).'" method="POST" onsubmit="return confirm(\'Naozaj zmazať?\');" style="display:inline-block;">
                      '.csrf_field().method_field('DELETE').'
                      <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                  </form>
                </div>
            ';
            })

            ->rawColumns(['name','email','action'])
            ->make(true);
    }

    public function potentialCustomers()
    {
        $q = PotentialCustomer::query()
            ->orderByRaw("CASE WHEN status = 'no_interest' THEN 1 ELSE 0 END")
            ->orderByDesc('id');

        return DataTables::of($q)
            ->addIndexColumn()

            ->addColumn('customer_info', function (PotentialCustomer $pc) {
                $title = $pc->title ? '<strong>'.e($pc->title).'</strong>' : '—';

                // Spracovanie webu ako pole
                $webs = [];
                if ($pc->web) {
                    $webData = json_decode($pc->web, true);
                    if (is_array($webData) && count($webData) > 0) {
                        $webs = array_slice($webData, 0, 2);
                    } elseif (is_string($pc->web)) {
                        $webs = [$pc->web];
                    }
                }

                $webDisplay = '';
                foreach ($webs as $web) {
                    if (filter_var($web, FILTER_VALIDATE_URL)) {
                        $webDisplay .= '<br><small class="text-muted">Web: <a href="'.e($web).'" target="_blank">'.e($web).'</a></small>';
                    }
                }

                $url = $pc->url ? '<br><small class="text-muted">URL: '.e($pc->url).'</small>' : '';

                return $title . $webDisplay . $url;
            })

            ->addColumn('category', function (PotentialCustomer $pc) {
                return $pc->category ? '<span class="badge badge-info">'.e($pc->category).'</span>' : '—';
            })

            ->addColumn('contact', function (PotentialCustomer $pc) {
                $contactHtml = '';

                if ($pc->email) {
                    $emails = json_decode($pc->email, true);
                    if (is_array($emails) && count($emails) > 0) {
                        foreach (array_slice($emails, 0, 2) as $email) { // Zobraziť max 2 emaily
                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $contactHtml .= '<a href="mailto:'.e($email).'" class="btn btn-sm btn-outline-primary mb-1" title="Poslať email">
                                <i class="fas fa-envelope"></i> '.e($email).'
                            </a><br>';
                            }
                        }
                    } elseif (is_string($pc->email) && filter_var($pc->email, FILTER_VALIDATE_EMAIL)) {
                        $contactHtml .= '<a href="mailto:'.e($pc->email).'" class="btn btn-sm btn-outline-primary mb-1" title="Poslať email">
                        <i class="fas fa-envelope"></i> '.e($pc->email).'
                    </a><br>';
                    }
                }

                if ($pc->phone) {
                    $phones = json_decode($pc->phone, true);
                    if (is_array($phones) && count($phones) > 0) {
                        foreach (array_slice($phones, 0, 2) as $phone) { // Zobraziť max 2 telefóny
                            $cleanPhone = preg_replace('/[^0-9+]/', '', $phone);
                            $contactHtml .= '<a href="tel:'.e($cleanPhone).'" class="btn btn-sm btn-outline-success mb-1" title="Zavolať">
                            <i class="fas fa-phone"></i> '.e($phone).'
                        </a><br>';
                        }
                    }
                }

                if ($pc->page) {
                    $pages = json_decode($pc->page, true);
                    if (is_array($pages) && count($pages) > 0) {
                        foreach (array_slice($pages, 0, 1) as $page) { // Zobraziť max 1 stránku
                            if (filter_var($page, FILTER_VALIDATE_URL)) {
                                $contactHtml .= '<a href="'.e($page).'" target="_blank" class="btn btn-sm btn-outline-info mb-1" title="Otvoriť stránku">
                                <i class="fas fa-globe"></i> Stránka
                            </a>';
                            }
                        }
                    } elseif (is_string($pc->page) && filter_var($pc->page, FILTER_VALIDATE_URL)) {
                        $contactHtml .= '<a href="'.e($pc->page).'" target="_blank" class="btn btn-sm btn-outline-info mb-1" title="Otvoriť stránku">
                        <i class="fas fa-globe"></i> Stránka
                    </a>';
                    }
                }

                return $contactHtml ?: '';
            })

            ->addColumn('status_badge', function (PotentialCustomer $pc) {
                $statuses = [
                    '0' => ['secondary', 'Nová'],
                    '1' => ['success', 'Lead'],
                    'no_interest' => ['danger', 'Nemá záujem'],
                ];

                $status = $statuses[$pc->status] ?? $statuses['0'];
                return '<span class="badge badge-'.$status[0].'">'.$status[1].'</span>';
            })

            ->addColumn('created_at', function (PotentialCustomer $pc) {
                return $pc->created_at?->format(config('system.datetime_format', 'Y-m-d H:i'));
            })

            ->addColumn('action', function (PotentialCustomer $pc) {
                $del = route('admin.potential-customers.destroy', $pc->id);

                $quickActions = '
            <div class="btn-group btn-group-sm mb-1" role="group">
                <form action="'.route('admin.potential-customers.quick_update', $pc->id).'" method="POST" style="display:inline;">
                    '.csrf_field().method_field('PATCH').'
                    <input type="hidden" name="status" value="1">
                    <button type="submit" class="btn btn-outline-success" title="Označiť ako Lead">
                        <i class="fas fa-check"></i> Lead
                    </button>
                </form>
                <form action="'.route('admin.potential-customers.quick_update', $pc->id).'" method="POST" style="display:inline;">
                    '.csrf_field().method_field('PATCH').'
                    <input type="hidden" name="status" value="no_interest">
                    <button type="submit" class="btn btn-outline-danger" title="Označiť ako Nemá záujem">
                        <i class="fas fa-times"></i> Nie
                    </button>
                </form>
            </div>
            <br>';

                // Základné akcie
                $basicActions = '
            <div class="btn-group" role="group">
                <form action="'.e($del).'" method="POST" onsubmit="return confirm(\'Naozaj zmazať?\');" style="display:inline-block;">
                    '.csrf_field().method_field('DELETE').'
                    <button class="btn btn-sm btn-outline-danger" title="Zmazať">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>';

                return $quickActions . $basicActions;
            })

            ->setRowId('id')
            ->rawColumns(['customer_info', 'category', 'contact', 'status_badge', 'action'])
            ->make(true);
    }

    public function newsletter()
    {
        $newsletter = Newsletter::orderBy('id', 'desc')->select('*');
        return DataTables::of($newsletter)
            ->addIndexColumn()
            ->editColumn('subject', function ($newsletter) {
                return $newsletter->subject ?? null;
            })
            ->editColumn('message', function ($newsletter) {
                return view('newsletter::datatable.preview', compact('newsletter'))->render();
            })
            ->editColumn('sending_done', function ($newsletter) {
                return $newsletter->sending_done
                    ? '<span class="badge badge-success">Hotovo</span>'
                    : '<span class="badge badge-warning">Čaká na odoslanie</span>';
            })
            ->editColumn('created_at', function ($newsletter) {
                return $newsletter->created_formated;
            })
            ->editColumn('action', function ($newsletter) {
                return view('newsletter::datatable.action', compact('newsletter'))->render();
            })
            ->rawColumns(['message','sending_done','action'])
            ->make();
    }



    public function leads($request)
    {
        $q = Lead::query()->orderByDesc('id')->select('*');

        // voliteľný filter podľa tabu (new / in_progress / closed)
        if ($status = $request->get('status')) {
            if (in_array($status, ['new','contact','waiting','close'], true)) {
                $q->where('status', $status);
            }
        }

        return DataTables::of($q)
            ->addIndexColumn()
            ->editColumn('data', function ($item) {
                return view('admin::leads.datatable.lead', [
                    'data' => json_decode($item->data),
                ])->render();
            })
            // necháme ako int, ikonky rieši front (render v DataTables configu)
            ->editColumn('send_lead_message', fn($item) => (int) $item->send_lead_message)
            ->editColumn('send_cp', fn($item) => (int) $item->send_cp)
            ->editColumn('action', function ($item) {
                return view('admin::leads.datatable.action', compact('item'))->render();
            })
            ->rawColumns(['data', 'action']) // tieto sú HTML; ostatné nech sú plain
            ->make();
    }



    public function auditLogs()
    {
        $item = AppLog::orderBy('id', 'desc')->select('*');

        return DataTables::of($item)
            ->addIndexColumn()
            ->editColumn('user_id', function ($item) {
                return view('admin::audit-log.datatable.user', compact('item'))->render();
            })
            ->editColumn('data', function ($item) {
                return view('admin::audit-log.datatable.data', compact('item'))->render();
            })
            ->editColumn('error', function ($item) {
                return view('admin::audit-log.datatable.error', compact('item'))->render();
            })
            ->rawColumns(['data', 'error', 'user_id'])
            ->make();

    }

    public function auditLogPopover($id) {
        $item = AppLog::findOrFail($id);

        $rows = '';
        $data = is_array($item->request) ? $item->request : (json_decode($item->request, true) ?? []);
        $tokenIsNull     = array_key_exists('_token', $data) && $data['_token'] === null;
        $recaptchaIsNull = array_key_exists('g-recaptcha-response', $data) && $data['g-recaptcha-response'] === null;

        if ($tokenIsNull || $recaptchaIsNull) {
            $rows = '<div class="kv"><span class="k">Is blocked</span><span class="v"><i class="fa-solid fa-circle-check text-danger"></i></span></div>';
        }

        unset($data['_token'], $data['g-recaptcha-response']);
        if (isset($data['password'])) {
            $len = mb_strlen((string)$data['password']);
            $data['password'] = str_repeat('•', min($len, 10));
        }
        foreach ($data as $k => $v) {
            if (is_array($v)) $v = json_encode($v, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $v = (string)$v;
            if (mb_strlen($v) > 160) $v = mb_substr($v, 0, 160) . '…';
            $rows .= '<div class="kv"><span class="k">'.e($k).'</span><span class="v">'.e($v).'</span></div>';
        }

        $html = '<div class="popover-kv">'.$rows.'</div>';

        return response($html, 200)->header('Content-Type', 'text/html; charset=UTF-8');
    }

    public function auditLogErrorTrace($id) {
        $item = AppLog::findOrFail($id);
        $trace = (string)($item->error_trace ?? '');

        // skrátenie veľmi dlhých stackov (napr. na 8–12 kB)
        if (mb_strlen($trace) > 12000) {
            $trace = mb_substr($trace, 0, 12000) . "\n…";
        }

        $html = '<pre class="trace-pre">'.e($trace).'</pre>';
        return response($html, 200)->header('Content-Type', 'text/html; charset=UTF-8');
    }

}
