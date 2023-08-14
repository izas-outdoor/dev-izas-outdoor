Public Class clsBXLAPI

    Private m_Is64Bit As Boolean = False

    Public Sub New()
        m_Is64Bit = Is64Bit()
    End Sub

    Public Function Is64Bit() As Boolean
        Dim retVal As Boolean = True
        If System.Environment.GetEnvironmentVariable("PROCESSOR_ARCHITECTURE") = "x86" Then
            retVal = False
        End If

        Return retVal
    End Function

#Region " Function List "

    Public Delegate Function BXLCallBackDelegate(ByVal status As Integer) As Integer
    Public Delegate Function BXLMsrCallBackDelegate(ByVal msrData As IntPtr, ByVal dataSize As Integer, ByVal trackNumber As Integer) As Integer


    Public Function BidiOpenMonPrinter(ByVal szPrinterName As String) As Boolean
        If (m_Is64Bit) Then
            Return clsBXLAPI_x64.BidiOpenMonPrinter(szPrinterName)
        Else
            Return clsBXLAPI_x86.BidiOpenMonPrinter(szPrinterName)
        End If
    End Function

    Public Function BidiCloseMonPrinter() As Boolean
        If (m_Is64Bit) Then
            Return clsBXLAPI_x64.BidiCloseMonPrinter()
        Else
            Return clsBXLAPI_x86.BidiCloseMonPrinter()
        End If
    End Function

    Public Function BidiGetStatus() As Integer
        If (m_Is64Bit) Then
            Return clsBXLAPI_x64.BidiGetStatus()
        Else
            Return clsBXLAPI_x86.BidiGetStatus()
        End If
    End Function

    Public Function BidiSetCallBackFunction(ByVal statusCallback As BXLCallBackDelegate, ByVal msrCallback As BXLMsrCallBackDelegate) As Boolean
        If (m_Is64Bit) Then
            Return clsBXLAPI_x64.BidiSetCallBackFunction(statusCallback, msrCallback)
        Else
            Return clsBXLAPI_x86.BidiSetCallBackFunction(statusCallback, msrCallback)
        End If
    End Function

    Public Function BidiSetStatusBackFunction(ByVal callbackFunc As BXLCallBackDelegate) As Boolean
        If (m_Is64Bit) Then
            Return clsBXLAPI_x64.BidiSetStatusBackFunction(callbackFunc)
        Else
            Return clsBXLAPI_x86.BidiSetStatusBackFunction(callbackFunc)
        End If
    End Function

    Public Function BidiCancelCallBackFunction() As Boolean
        If (m_Is64Bit) Then
            Return clsBXLAPI_x64.BidiCancelCallBackFunction()
        Else
            Return clsBXLAPI_x86.BidiCancelCallBackFunction()
        End If
    End Function

    Public Function BidiCancelStatusBack() As Boolean
        If (m_Is64Bit) Then
            Return clsBXLAPI_x64.BidiCancelStatusBack()
        Else
            Return clsBXLAPI_x86.BidiCancelStatusBack()
        End If
    End Function


    Public Function ConnectPrinter(ByVal szPrinterName As String) As Boolean
        If (m_Is64Bit) Then
            Return clsBXLAPI_x64.ConnectPrinter(szPrinterName)
        Else
            Return clsBXLAPI_x86.ConnectPrinter(szPrinterName)
        End If
    End Function

    Public Sub DisconnectPrinter()
        If m_Is64Bit = True Then
            clsBXLAPI_x64.DisconnectPrinter()
        Else
            clsBXLAPI_x86.DisconnectPrinter()
        End If
    End Sub

    Public Function Start_Doc(ByVal szDocName As String) As Boolean
        If (m_Is64Bit) Then
            Return clsBXLAPI_x64.Start_Doc(szDocName)
        Else
            Return clsBXLAPI_x86.Start_Doc(szDocName)
        End If
    End Function

    Public Sub End_Doc()
        If (m_Is64Bit) Then
            clsBXLAPI_x64.End_Doc()
        Else
            clsBXLAPI_x86.End_Doc()
        End If
    End Sub

    Public Function Start_Page() As Boolean
        If (m_Is64Bit) Then
            Return clsBXLAPI_x64.Start_Page()
        Else
            Return clsBXLAPI_x86.Start_Page()
        End If
    End Function

    Public Sub End_Page()
        If (m_Is64Bit) Then
            clsBXLAPI_x64.End_Page()
        Else
            clsBXLAPI_x86.End_Page()
        End If
    End Sub

    Public Function PrintDeviceFont(ByVal nPositionX As Integer, ByVal nPositionY As Integer, ByVal szFontName As String, ByVal nFontSize As Integer, ByVal szData As String) As Integer
        If (m_Is64Bit) Then
            Return clsBXLAPI_x64.PrintDeviceFont(nPositionX, nPositionY, szFontName, nFontSize, szData)
        Else
            Return clsBXLAPI_x86.PrintDeviceFont(nPositionX, nPositionY, szFontName, nFontSize, szData)
        End If
    End Function

    Public Function PrintTrueFont(ByVal nPositionX As Integer, ByVal nPositionY As Integer, ByVal szFontName As String, ByVal nFontSize As Integer, ByVal szData As String, _
                                    Optional ByVal bBold As Boolean = False, Optional ByVal nRotation As Integer = 0, Optional ByVal bItalic As Boolean = False, Optional ByVal bUnderline As Boolean = False) As Integer
        If (m_Is64Bit) Then
            Return clsBXLAPI_x64.PrintTrueFont(nPositionX, nPositionY, szFontName, nFontSize, szData, _
                                            bBold, nRotation, bItalic, bUnderline)
        Else
            Return clsBXLAPI_x86.PrintTrueFont(nPositionX, nPositionY, szFontName, nFontSize, szData, _
                                            bBold, nRotation, bItalic, bUnderline)
        End If
    End Function

    Public Function PrintBitmap(ByVal nPositionX As Integer, ByVal nPositionY As Integer, ByVal bitmapFile As String) As Integer
        If (m_Is64Bit) Then
            Return clsBXLAPI_x64.PrintBitmap(nPositionX, nPositionY, bitmapFile)
        Else
            Return clsBXLAPI_x86.PrintBitmap(nPositionX, nPositionY, bitmapFile)
        End If
    End Function

#End Region


End Class
