<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // product list
    public function productList() {
        $product = Product::orderBy('id', 'desc')->get();
        return response()->json($product, 200);
    }

    // category list
    public function categoryList() {
        $category = Category::orderBy('id', 'desc')->get();
        return response()->json($category, 200);
    }

    // create category
    public function createCategory(Request $request) {
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
    }

    // create product
    public function createProduct(Request $request) {
        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'price' => $request->price,
            'waiting_time' => $request->waiting_time,
            'view_count' => $request->view_count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Product::create($data);
        return response()->json($response, 200);
    }

    // delete category
    public function deleteCategory($id) {
        $data = Category::where('id', $id)->first();

        if(isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'Delete Success', 'deleteData' => $data], 200);
        }
        return response()->json(['status' => false, 'message' => 'There is no category...'], 404);
    }

    // delete product
    public function deleteProduct($id) {
        $data = Product::where('id', $id)->first();

        if(isset($data)) {
            Product::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'Delete Success', 'deleteData' => $data], 200);
        }
        return response()->json(['status' => false, 'message' => 'There is no product...'], 404);
    }

    // category details
    public function categoryDetails($id) {
        $data = Category::where('id', $id)->first();

        if(isset($data)) {
            return response()->json(['status' => true, 'categoryData' => $data], 200);
        }
        return response()->json(['status' => false, 'message' => 'There is no category...'], 404);
    }

    // update category
    public function updateCategory(Request $request) {
        $categoryId = $request->category_id;
        $dbSource = Category::where('id', $categoryId)->first();

        if(isset($dbSource)) {
            $data = $this->getCategoryData($request);
            Category::where('id', $categoryId)->update($data);
            $response = Category::where('id', $categoryId)->first();
            return response()->json(['status' => true, 'message' => 'Category Updated.', 'Category' => $response], 200,);
        }

        return response()->json(['status' => false, 'message' => 'There is no category to update.'], 404);
    }

    // update product
    public function updateProduct(Request $request) {
        $productId = $request->product_id;
        $dbSource = Product::where('id', $productId)->first();

        if(isset($dbSource)) {
            $data = $this->getProductData($request);
            Product::where('id', $productId)->update($data);
            $response = Product::where('id', $productId)->first();
            return response()->json(['status' => true, 'message' => 'Product Updated.', 'Product' => $response], 200,);
        }

        return response()->json(['status' => false, 'message' => 'There is no product to update.'], 404);
    }

    // create contact
    public function createContact(Request $request) {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        Contact::create($data);
        $contact = Contact::orderBy('created_at' ,'desc')->get();
        return response()->json($contact, 200);
    }

    // contact list
    public function ContactList() {
        $contact = Contact::orderBy('created_at','desc')->get();
        return response()->json($contact, 200);
    }

    // delete contact
    public function deleteContact($id) {
        $data = Contact::where('id', $id)->first();

        if(isset($data)) {
            Contact::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'Delete Success', 'deleteData' => $data], 200);
        }
        return response()->json(['status' => false, 'message' => 'There is no contact...'], 404);
    }

    // update contact
    public function updateContact(Request $request) {
        $contactId = $request->contact_id;
        $dbSource = Contact::where('id', $contactId)->first();

        if(isset($dbSource)) {
            $data = $this->getContactData($request);
            Contact::where('id', $contactId)->update($data);
            $response = Contact::where('id', $contactId)->first();
            return response()->json(['status' => true, 'message' => 'Contact Updated.', 'Contact' => $response], 200,);
        }

        return response()->json(['status' => false, 'message' => 'There is no contact to update.'], 404);
    }

    // get category data
    private function getCategoryData($request) {
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ];
    }

    // get product data
    private function getProductData($request) {
        return [
            'name'=> $request->product_name,
            'description'=> $request->product_description,
            'image'=> $request->product_image,
            'price'=> $request->product_price,
            'waiting_time'=> $request->product_waiting_time,
            'view_count'=> $request->product_view_count,
            'updated_at'=> Carbon::now(),
        ];
    }

    // get contact data
    private function getContactData($request) {
        return [
            'name' => $request->contact_name,
            'email' => $request->contact_email,
            'subject' => $request->contact_subject,
            'message' => $request->contact_message,
            'updated_at' => Carbon::now(),
        ];
    }
}
