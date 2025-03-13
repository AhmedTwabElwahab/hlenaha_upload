<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\web\BannersRequest;
use App\Models\Banners;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Exception;

class BannersController extends BaseController
{
    /**
     * send all banners to frontEnd.
     * @return View
     */
    public function index(): View
    {
        $banners = Banners::paginate(APP_PAGINATE);
        return view('Banners.index',compact('banners'));

    }

    /**
     * Display the Create Banners page.
     * @return View
     */
    public function create(): View
    {
        return view('Banners.create');
    }

    /**
     * Store a new Banners in dataBase.
     * @param BannersRequest $request
     * @return RedirectResponse
     */
    public function store(BannersRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try
        {
            Banners::createBanners($request);

            DB::commit();
            return redirect()->route('Banners.index')->withStatus(__('global.create_success'));
        } catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            return redirect()->back()->withErrors($message)->withInput();
        }
    }


    /**
     * Show the Edit Banners Information page.
     * @param Banners $banner
     * @return View
     */
    public function edit(Banners $banner): View
    {
        return view('Banners.edit',compact('banner'));
    }

    /**
     * Update the Banners information.
     * @param BannersRequest $request
     * @param Banners $banner
     * @return RedirectResponse
     */
    public function update(BannersRequest $request, Banners $banner): RedirectResponse
    {
        DB::beginTransaction();
        try
        {
            if($request->file('image'))
            {
                $file = $request->file('image');
                $fileName = time() . '.' . $file->extension();
                $file->move(public_path(BANNERS_IMAGES_FOLDER), $fileName);
                $banner->image = BANNERS_IMAGES_FOLDER.DS.$fileName;
            }

            $banner->title   = $request->input('title');
            $banner->disc    = $request->input('disc');


            if (!$banner->update())
            {
                throw new Exception('update_error',APP_ERROR);
            }
            DB::commit();
            return redirect()->route('Banners.index')->withStatus(__('global.create_success'));
        } catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            return redirect()->back()->withErrors(__('global.create_error'))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Banners $banner
     * @return RedirectResponse
     */
    public function destroy(Banners $banner): RedirectResponse
    {
        DB::beginTransaction();
        try {
            if (!$banner->delete())
            {
                throw new Exception('delete_error',APP_ERROR);
            }
            DB::commit();
            return redirect()->route('Banners.index');
        } catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            return redirect()->back()->withErrors(__('global.delete_error'));
        }
    }
}

