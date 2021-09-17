<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Iodev\Whois\Factory;

class DomainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = Domain::query()->orderBy('check_status', 'asc')->paginate(30);
        return response()->json(['code' => 200, 'data' => $domains]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array_filter($request->only('url', 'name', 'remind_time'));
        //
        Domain::query()->create($data);
        return response()->json(['code' => 200, 'data' => '']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array_filter($request->only('url', 'name', 'remind_time'));
        Domain::query()->where('id', $id)->update($data);
        return response()->json(['code' => 200, 'data' => '']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Domain::query()->where('id', $id)->delete();
        return response()->json(['code' => 200, 'data' => '']);
    }

    public function allDomains()
    {

        $domains = Domain::query()->get();
        return response()->json(['code' => 200, 'data' => $domains]);
    }

    public function check()
    {
        $domains = Domain::query()->get();
        $whois = Factory::get()->createWhois();
        $check_time = Carbon::now('Asia/Shanghai')->format('Y-m-d H:i:s');
        foreach ($domains as $domain) {
            $info = $whois->loadDomainInfo($domain->name);
            try {
                if (!$info->expirationDate) {
                    $data['check_status'] = -1;
                    $data['check_time'] = $check_time;
                    Domain::query()->where('id', $domain->id)->update($data);
                  
                } else {
                    $data['check_status'] = 1;
                    $data['check_time'] = $check_time;
                    $data['expired_time'] = date("Y-m-d H:i:s", $info->expirationDate);
                    Domain::query()->where('id', $domain->id)->update($data);
                }
            } catch (\Exception $e) {
                $data['check_status'] = -1;
                $data['check_time'] = $check_time;
                Domain::query()->where('id', $domain->id)->update($data);
            }
        }

        return response()->json(['code' => 200, 'data' => '']);
        // print_r([
        //     'Domain created' => date("Y-m-d H:i:s", $info->creationDate),
        //     'Domain expires' => date("Y-m-d H:i:s", $info->expirationDate),
        // ]);
    }
}
