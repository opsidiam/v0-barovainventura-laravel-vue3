<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PostPackages;
use App\Models\User;
use App\Models\UserFile;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\StoreDeviceLoanRequest;
use Modules\Admin\Models\ContractForm;
use Modules\Admin\Models\Note;
use Modules\Admin\Models\Partner;
use Modules\Admin\Services\AdminUserService;
use Modules\Bar\Models\Bar;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin::users.index');
    }

    public function show (User $user)
    {
        $partners = Partner::orderBy('last_name')->get();
        $deliveryInfo = ContractForm::where('user_id', $user->id)->exists();
        $postalPackages = PostPackages::where('user_id', $user->id)->get();
        return view('admin::users.detail', compact('user', 'partners', 'deliveryInfo', 'postalPackages'));
    }

    public function resetLicence(AdminUserService $adminUserService, $id)
    {

        $data = $adminUserService->resetLicence($id);
        if($data){
            return back()->with('message',__('admin.messages.success.license.reset'));
        }
        return back()->with('warning','Nastala chyba');
    }

    public function assignLicence(AdminUserService $adminUserService)
    {

        return $adminUserService->assignLicence();
    }

    public function storeFile(User $user, AdminUserService $adminUserService)
    {

        return $adminUserService->storeFile($user);
    }

    public function generateContractWeight(User $user, AdminUserService $adminUserService)
    {

        return $adminUserService->generateContractWeight($user);
    }

    public function downloadFile(User $user, UserFile $file, AdminUserService $adminUserService)
    {

        return $adminUserService->downloadFile($user, $file);
    }

    public function destroyFile(User $user, UserFile $file, AdminUserService $adminUserService)
    {

        return $adminUserService->destroyFile($user, $file);
    }

    public function destroy($id, AdminUserService $adminUserService)
    {
        $data = $adminUserService->destroy($id);
        if($data){
            return back()->with('message', __('admin.messages.success.user-delete'));
        }
        return back()->with('warning','Nastala chyba');
    }

    public function storeContracts(User $user, AdminUserService $adminUserService)
    {
        return $adminUserService->storeContracts($user);
    }

    public function storeDeviceLoan(User $user, AdminUserService $service)
    {
        return $service->storeDeviceLoan($user);
    }

    public function markDeviceLoanPurchased(User $user, AdminUserService $service)
    {
        return $service->markDeviceLoanPurchased($user);
    }

    public function markDeviceLoanReturned(User $user, AdminUserService $service)
    {
        return $service->markDeviceLoanReturned($user);
    }

    public function createPostalSheet(User $user, AdminUserService $service)
    {
        $data = $service->createPostalSheet($user);
        if(isset($data['success'])){
            return back()->with('message', __('admin.messages.success.postal-package'));
        }
        if(isset($data['error'])){
            return back()->with('warning', $data['error']);
        }
        return back()->with('warning','Nastala chyba');
    }

    public function deviceLoanContract(User $user, AdminUserService $service)
    {
        $data = $service->deviceLoanContract($user);
        if($data){
            return back()->with('message', __('admin.messages.success.user-loan-contract'));
        }
        return back()->with('warning','Nastala chyba');
    }

    public function storeNote(Request $request)
    {
        $data = $request->validate([
            'notable_type' => 'required|string|max:191',
            'notable_id'   => 'required|integer',
            'body'         => 'required|string|max:10000',
        ]);

        $allowed = [
            User::class,
            Bar::class,
            UserFile::class,
        ];
        if (!in_array($data['notable_type'], $allowed, true)) {
            return back()->with('warning', 'Neplatný cieľ poznámky.');
        }

        Note::create([
            'notable_type' => $data['notable_type'],
            'notable_id'   => $data['notable_id'],
            'author_id'    => (int)auth()->id(),
            'body'         => $data['body'],
        ]);

        return back()->with('message', 'Poznámka bola pridaná.');
    }

    public function destroyNote(Note $note)
    {
        $note->delete();
        return back()->with('message', 'Poznámka bola odstránená.');
    }

}
