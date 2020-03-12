<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAccountRequest;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Department;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AccountsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Account::with(['departments'])->select(sprintf('%s.*', (new Account)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'account_show';
                $editGate      = 'account_edit';
                $deleteGate    = 'account_delete';
                $crudRoutePart = 'accounts';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('id_number', function ($row) {
                return $row->id_number ? $row->id_number : "";
            });
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : "";
            });
            $table->editColumn('middle_name', function ($row) {
                return $row->middle_name ? $row->middle_name : "";
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : "";
            });
            $table->editColumn('designation', function ($row) {
                return $row->designation ? $row->designation : "";
            });

            $table->editColumn('department', function ($row) {
                $labels = [];

                foreach ($row->departments as $department) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $department->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'department']);

            return $table->make(true);
        }

        return view('admin.accounts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::all()->pluck('name', 'id');

        return view('admin.accounts.create', compact('departments'));
    }

    public function store(StoreAccountRequest $request)
    {
        $account = Account::create($request->all());

        $account->departments()->sync($request->input('departments', []));

        return redirect()->route('admin.accounts.index');
    }

    public function edit(Account $account)
    {
        abort_if(Gate::denies('account_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::all()->pluck('name', 'id');

        $account->load('departments');

        return view('admin.accounts.edit', compact('departments', 'account'));
    }

    public function update(UpdateAccountRequest $request, Account $account)
    {
        $account->update($request->all());

        $account->departments()->sync($request->input('departments', []));

        return redirect()->route('admin.accounts.index');
    }

    public function show(Account $account)
    {
        abort_if(Gate::denies('account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account->load('departments', 'requestorApprovedRequests');

        return view('admin.accounts.show', compact('account'));
    }

    public function destroy(Account $account)
    {
        abort_if(Gate::denies('account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account->delete();

        return back();
    }

    public function massDestroy(MassDestroyAccountRequest $request)
    {
        Account::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
