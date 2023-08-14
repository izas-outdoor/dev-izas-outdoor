Public Class clsBXLAPI_x86

#Region " DLL API Function "

    'Calls the specified printer to use Status API.
    Public Declare Function BidiOpenMonPrinter Lib "BXLPStatusBack.dll" (ByVal szPrinterName As String) As Boolean

    'Closes Status API.
    Public Declare Function BidiCloseMonPrinter Lib "BXLPStatusBack.dll" () As Boolean

    'Provides notification regarding the call of the callback function notifying the application when the ASB status of Status API changes.
    Public Declare Function BidiSetStatusBackFunction Lib "BXLPStatusBack.dll" (ByVal callbackFunc As clsBXLAPI.BXLCallBackDelegate) As Boolean

    Public Declare Function BidiSetCallBackFunction Lib "BXLPStatusBack.dll" (ByVal statusCallback As clsBXLAPI.BXLCallBackDelegate, _
                                                                                ByVal msrCallback As clsBXLAPI.BXLMsrCallBackDelegate _
                                                                                ) As Boolean

    'Cancels the auto status notification function. This function is applicable to BiSetStatusBackFunction,
    Public Declare Function BidiCancelStatusBack Lib "BXLPStatusBack.dll" () As Boolean
    Public Declare Function BidiCancelCallBackFunction Lib "BXLPStatusBack.dll" () As Boolean

    'Acquires the ASB status from Status API when required by the application.
    Public Declare Function BidiGetStatus Lib "BXLPStatusBack.dll" () As Integer


    Public Declare Function ConnectPrinter Lib "BXLPDC.dll" Alias "ConnectPrinter" ( _
                                                ByVal szPrinterName As String _
                                                ) As Boolean

    Public Declare Sub DisconnectPrinter Lib "BXLPDC.dll" Alias "DisconnectPrinter" ()

    Public Declare Function Start_Doc Lib "BXLPDC.dll" Alias "Start_Doc" ( _
                                                ByVal szDocName As String _
                                                ) As Boolean

    Public Declare Sub End_Doc Lib "BXLPDC.dll" Alias "End_Doc" ()

    Public Declare Function Start_Page Lib "BXLPDC.dll" Alias "Start_Page" () As Boolean

    Public Declare Sub End_Page Lib "BXLPDC.dll" Alias "End_Page" ()

    Public Declare Function PrintDeviceFont Lib "BXLPDC.dll" Alias "PrintDeviceFont" ( _
                                                ByVal nPositionX As Integer, ByVal nPositionY As Integer, _
                                                ByVal szFontName As String, ByVal nFontSize As Integer, ByVal szData As String _
                                                ) As Integer

    Public Declare Function PrintTrueFont Lib "BXLPDC.dll" Alias "PrintTrueFont" ( _
                                                ByVal nPositionX As Integer, ByVal nPositionY As Integer, _
                                                ByVal szFontName As String, ByVal nFontSize As Integer, ByVal szData As String, _
                                                Optional ByVal bBold As Boolean = False, Optional ByVal nRotation As Integer = 0, _
                                                Optional ByVal bItalic As Boolean = False, Optional ByVal bUnderline As Boolean = False _
                                                ) As Integer

    Public Declare Function PrintBitmap Lib "BXLPDC.dll" Alias "PrintBitmap" ( _
                                                ByVal nPositionX As Integer, ByVal nPositionY As Integer, ByVal bitmapFile As String _
                                                ) As Integer

#End Region

End Class
