package controller;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.Queue;
import java.util.concurrent.ConcurrentLinkedQueue;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/Chat")
public class ChatServlet extends HttpServlet {
	private static final Queue<String> messages = new ConcurrentLinkedQueue<>();
	// スレッドセーフなQueueインスタンスを作成します。このQueueは文字列のメッセージを保持します。静的（static）であり、すべてのChatServletインスタンス間で共有されます。

	@Override
	protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
		// HTTP
		// GETリクエストを処理するためのメソッドをオーバーライド（再定義）します。HttpServletRequestオブジェクトはリクエスト情報を、HttpServletResponseオブジェクトはレスポンス情報を保持します。

		resp.setContentType("text/html");
		// HTTPレスポンスのContent-Typeヘッダを"text/html"に設定します。これにより、レスポンスボディがHTMLであることをブラウザに伝えます。

		PrintWriter out = resp.getWriter();
		// HttpServletResponseオブジェクトからPrintWriterを取得します。これにより、レスポンスボディにテキストを書き込むことができます。

		messages.forEach(out::println);
		// "messages"
		// Queueの各メッセージを、PrintWriterのprintlnメソッドを使ってレスポンスボディに書き込みます。つまり、保存されているすべてのメッセージをクライアントに送り返します。
	}

	@Override
	protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
		// HTTP POSTリクエストを処理するためのメソッドをオーバーライド（再定義）します。

		String message = req.getParameter("message");
		// HttpServletRequestオブジェクトから"message"という名前のパラメータを取得します。このパラメータは、クライアントから送信されたメッセージを含んでいます。

		messages.add(message);
		// 取得したメッセージを"messages" Queueに追加します。
	}
}