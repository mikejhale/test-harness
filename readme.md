# WordPress Test Harness # 

This plugin adds a **Test Harness** page to the WordPress admin. 

There are times when you need to run custom code as a test in WordPress, for example, testing hooks, checking for specific data, or anything else. This plugin provides a quick and easy way to run custom code. 

Note: You are required to modify the plugin code to include any test code you want to run. It does not accept PHP from the UI. This also lets you step through and debug your custom code. 

## To use the test harness: ##

1. Install this plugin on your WordPress site.
2. Modify the `test_harness_do_test()` method to include your test code.
3. Click the *run* button on the Test Harness admin page.
4. Return any results you want displayed on the page. 