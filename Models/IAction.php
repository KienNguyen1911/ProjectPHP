<?php

interface IAction {
    public function show();

    public function create($data);

    public function update($id, $data);

    public function delete($id);
}