<?php

namespace Fully\Http\Controllers;

use Fully\Http\Requests\CreateMenusRequest;
use Fully\Http\Requests\UpdateMenusRequest;
use Fully\Repositories\MenusRepository;
use Fully\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MenusController extends AppBaseController
{
    /** @var  MenusRepository */
    private $menusRepository;

    public function __construct(MenusRepository $menusRepo)
    {
        $this->menusRepository = $menusRepo;
    }

    /**
     * Display a listing of the Menus.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->menusRepository->pushCriteria(new RequestCriteria($request));
        $menuses = $this->menusRepository->all();

        return view('menuses.index')
            ->with('menuses', $menuses);
    }

    /**
     * Show the form for creating a new Menus.
     *
     * @return Response
     */
    public function create()
    {
        return view('menuses.create');
    }

    /**
     * Store a newly created Menus in storage.
     *
     * @param CreateMenusRequest $request
     *
     * @return Response
     */
    public function store(CreateMenusRequest $request)
    {
        $input = $request->all();

        $menus = $this->menusRepository->create($input);

        Flash::success('Menus saved successfully.');

        return redirect(route('menuses.index'));
    }

    /**
     * Display the specified Menus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $menus = $this->menusRepository->findWithoutFail($id);

        if (empty($menus)) {
            Flash::error('Menus not found');

            return redirect(route('menuses.index'));
        }

        return view('menuses.show')->with('menus', $menus);
    }

    /**
     * Show the form for editing the specified Menus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $menus = $this->menusRepository->findWithoutFail($id);

        if (empty($menus)) {
            Flash::error('Menus not found');

            return redirect(route('menuses.index'));
        }

        return view('menuses.edit')->with('menus', $menus);
    }

    /**
     * Update the specified Menus in storage.
     *
     * @param  int              $id
     * @param UpdateMenusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMenusRequest $request)
    {
        $menus = $this->menusRepository->findWithoutFail($id);

        if (empty($menus)) {
            Flash::error('Menus not found');

            return redirect(route('menuses.index'));
        }

        $menus = $this->menusRepository->update($request->all(), $id);

        Flash::success('Menus updated successfully.');

        return redirect(route('menuses.index'));
    }

    /**
     * Remove the specified Menus from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $menus = $this->menusRepository->findWithoutFail($id);

        if (empty($menus)) {
            Flash::error('Menus not found');

            return redirect(route('menuses.index'));
        }

        $this->menusRepository->delete($id);

        Flash::success('Menus deleted successfully.');

        return redirect(route('menuses.index'));
    }
}
