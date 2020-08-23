<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use App\Http\Requests\LinkShorten;
use App\Transformers\Link\LinkTransformer;

class LinkController extends Controller
{
    protected $link_repo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LinkRepositoryInterface $link_repo)
    {
        $this->middleware('auth');
        $this->link_repo = $link_repo;
    }

    private function renderError($message) {
        return redirect('/')->with('error', $message);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('url.shorten');
    }

    public function performShorten(LinkShorten $request) {
        try {
            $response = $this->link_repo->create($request->dbColumns());
            if($response)
                return response()->json(['status' => 'success', 'message' => 'Short Link Created Successfully', 'data' => $response]);
            else
                return response()->json(['status' => 'error', 'message' => 'Short Link Creation failed! please try again', 'data' => $response]);
        }
        catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function getUserLinks(Request $request, LinkTransformer $transform) {
        $response = $this->link_repo->getByUser($request->user_id);
        $links = $transform->transformCollection($response);
        $linksView = view('url.links')->with(['links' => $links])->render();

        return response()->json([
            'status' => 'success', 
            'message' => 'Links loaded Successfully', 
            'data' => [
                    'links' => $linksView 
                ]
        ]);
    }

    public function performRedirect(Request $request, $short_url) {
        $link = $this->link_repo->getByCode($short_url);

        if($link == null)
            return abort(404);

        if($link->is_disabled == 1)
            return abort(404);

        $long_url = $link->long_url;

        return redirect()->to($long_url);
    }

}
