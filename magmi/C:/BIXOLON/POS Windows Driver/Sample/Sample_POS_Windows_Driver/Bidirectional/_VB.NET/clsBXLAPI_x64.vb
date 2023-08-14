Public Class clsBXLAPI_x64

#Region " DLL API Function "

    'Calls the specified printer to use Status API.
    Public Declare Function BidiOpenMonPrinter Lib "BXLPStatusBack_x64.dll" (ByVal szPrinterName As String) As Boolean

    'Closes Status API.
    Public Declare Function BidiCloseMonPrinter Lib "BXLPStatusBack_x64.dll" () As Boolean

    'Provides notification regarding the call of the callback function notifying the application when the ASB status of Status API changes.
    Public Declare Function BidiSetStatusBackFunction Lib "BXLPStatusBack_x64.dll" (ByVal callbackFunc As clsBXLAPI.BXLCallBackDelegate) As Boolean

    Public Declare Function BidiSetCallBackFunction Lib "BXLPStatusBack_x64.dll" (ByVal statusCallback As clsBXLAPI.BXLCallBackDelegate, _
                                                                            ByVal msrCallback As clsBXLAPI.BXLMsrCallBackDelegate _
                                                                            ) As Boolean

    'Cancels the auto status notification function. This function is applicable to BiSetStatusBackFunction,
    Public Declare Function BidiCancelStatusBack Lib "BXLPStatusBack_x64.dll" () As Boolean

    Public Declare Function BidiCancelCallBackFunction Lib "BXLPStatusBack_x64.dll" () As Boolean

    'Acquires the ASB status from Status API when required by the application.
    Public Declare Function BidiGetStatus Lib "BXLPStatusBack_x64.dll" () As Integer


    Public Declare Function ConnectPrinter Lib "BXLPDC_x64.dll" Alias "ConnectPrinter" ( _
                                                ByVal szPrinterName As String _
                                                ) As Boolean

    Public Declare Sub DisconnectPrinter Lib "BXLPDC_x64.dll" Alias "DisconnectPrinter" ()

    Public Declare Function Start_Doc Lib "BXLPDC_x64.dll" Alias "Start_Doc" ( _
                                                ByVal szDocName As String _
                                                ) As Boolean

    Public Declare Sub End_Doc Lib "BXLPDC_x64.dll" Alias "End_Doc" ()

    Public Declare Function Start_Page Lib "BXLPDC_x64.dll" Alias "Start_Page" () As Boolean

    Public Declare Sub End_Page Lib "BXLPDC_x64.dll" Alias "End_Page" ()

    Public Declare Function PrintDeviceFont Lib "BXLPDC_x64.dll" Alias "PrintDeviceFont" ( _
                                                ByVal nPositionX As Integer, ByVal nPositionY As Integer, _
                                                ByVal szFontName As String, ByVal nFontSize As Integer, ByVal szData As String _
                                                ) As Integer

    Public Declare Function PrintTrueFont Lib "BXLPDC_x64.dll" Alias "PrintTrueFont" ( _
                                                ByVal nPositionX As Integer, ByVal nPositionY As Integer, _
                                                ByVal szFontName As String, ByVal nFontSize As Integer, ByVal szData As String, _
                                                Optional ByVal bBold As Boolean = False, Optional ByVal nRotation As Integer = 0, _
                                                Optional ByVal bItalic As Boolean = False, Optional ByVal bUnderline As Boolean = False _
                                                ) As Integer

    Public Declare Function PrintBitmap Lib "BXLPDC_x64.dll" Alias "PrintBitmap" ( _
                                                ByVal nPositionX As Integer, ByVal nPositionY As Integer, ByVal bitmapFile As String _
                                                ) As Integer

#End Region

End Class
