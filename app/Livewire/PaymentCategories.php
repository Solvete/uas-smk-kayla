<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PaymentCategory;

class PaymentCategories extends Component
{
    public $categories, $name, $price, $category_id;
    public $isModalOpen = false;

    public function render()
    {
        $this->categories = PaymentCategory::all();
        return view('livewire.payment-categories')->layout('components.layouts.app');
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->price = '';
        $this->category_id = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        PaymentCategory::updateOrCreate(['id' => $this->category_id], [
            'name' => $this->name,
            'price' => $this->price,
        ]);

        session()->flash('message', 
            $this->category_id ? 'Kategori diperbarui.' : 'Kategori ditambahkan.'
        );

        $this->closeModal();
    }

    public function edit($id)
    {
        $category = PaymentCategory::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->price = $category->price;
        $this->openModal();
    }

    public function delete($id)
    {
        PaymentCategory::find($id)->delete();
        session()->flash('message', 'Kategori dihapus.');
    }
}
