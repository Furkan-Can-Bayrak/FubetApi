<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EventSuggestionController extends Controller
{
    public function deneme(Request $request)
    {

        $answer1 ='Teknik Gezi,Eğlence';
        $answer2 ='Liderlik,Takım Çalışması, Yaratıcılık';
        $answer3 ='Açık Hava';
        $answer4 ='Bilgi Edinmek,Eğlenmek';
        $answer5 ='Hafta Sonu';

        // AI API çağrısı
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . env('GEMINI_API_KEY');
        $text = 'Bu mesaj Fırat Üniversitesi Bilişim ve Eğitim topluluğu için yapılan internet sitesinden gelen bir istektir. Sitemizde etkinlik öner diye bir seçenek var ve kişilere burada sorular soruluyor verdiği cevaba göre kişiye etkinlik öneriyoruz. Sana bu soruları atacağım sende bana istediğim formatta öneri mesajını yazabilir misin. Yazdığın mesajı direkt kullanıcıya göstereceğim için ekstra mesaj yazma direkt formata uygun önerini yaz.Sistemi anlatıyorum. Kullanıcı sisteme giriyor etkinlik öner seçeneğine tıklıyor ve orada karşısına sorular çıkıyor bu sorulara verdiği cevaba göre yapay zekaya istekgönderiliyor ve yapay zeka etkinlik öneriyor. Sonra gelen etkinlik önerisini kullanıcı revize edip adminlere sunacak yani sen adminlere bir fikir verirmiş gibi mesaj yaz. Hep bir öneri gibi olsun mesela şu parka gidebiliriz şurada oyun oynayabiliriz gibi sonra bu admine fikir olarak gidecek. Verdiğimiz alanları somutlaştır yazdığın yazı soyut kalmasın yaratıcılığını göster.Soruları kişinin verdikleri cevaplarıyla sana yazıyorum sende etkinlik öner.\n
        Hangi etkinlik türleri seni daha çok motive eder? ->'. $answer1.
        'Hangi becerileri geliştirmek istersin? ->'.$answer2.
        'Etkinliklerde hangi ortamları tercih edersin? ->'. $answer3.
        'Etkinlikten beklentin nedir? ->' . $answer4.
        'Etkinlik süresi tercihin nedir? ->'. $answer5.


        'Bana json veri olarak title ve description alanlarını açıklamalarıyla birlikte dön. Format:{"title": "...","description": "..."}';

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $text] // AI'ye gönderilen metin
                    ]
                ]
            ]
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, $payload);

            if ($response->successful()) {
                $data = $response->json();
                if ($data['candidates'][0]['finishReason'] === 'STOP') {
                    $aiGeneratedText = $data['candidates'][0]['content']['parts'][0]['text'];
                    $aiGeneratedText =trim($aiGeneratedText);
                    $aiGeneratedText = trim($aiGeneratedText);
                    $aiGeneratedText = preg_replace('/^```json|```$/', '', $aiGeneratedText); // Markdown formatı temizle
                    $aiGeneratedText = trim($aiGeneratedText);
dd(json_decode($aiGeneratedText));
                    return json_decode($aiGeneratedText);

                }
            }
            return response()->json(['error' => 'AI response error'], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
